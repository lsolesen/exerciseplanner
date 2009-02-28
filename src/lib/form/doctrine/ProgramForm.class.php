<?php

/**
 * Program form.
 *
 * @package    form
 * @subpackage Program
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProgramForm extends BaseProgramForm
{
    public function configure()
    {
        unset($this['created_at'],$this['updated_at'],$this['owner_id'],$this['creator_id'],$this['tags_list'],$this['exercises_list'],$this['id']);

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');

        $embeddedForm = new sfForm();
        $embeddedForm->getWidgetSchema()->setNameFormat('program[%s]');
        foreach($this->getObject()->getSets() as $set)
        {
            switch($set['otype'])
            {
                case 1: //rset
                    $embeddedForm->embedForm('existing_rep_'.$set->getId(), new RepSetForm($set));
                    break;
                case 2: //tset
                    $embeddedForm->embedForm('existing_time_'.$set->getId(), new TimeSetForm($set));
                    break;
            }
        }

        $this->embedForm('exercise_lists', $embeddedForm);
        $this->widgetSchema->setNameFormat('program[%s]');

    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        // add all the new todo fields that don't exist (because they were added dynamically)
        if(isset($taintedValues['exercise_lists']))
        {
            foreach($taintedValues['exercise_lists'] as $index => $set)
            {
                if (!isset($this['exercise_lists'][$index]))
                {
                    $type = $taintedValues['exercise_lists'][$index]['otype'];
                    switch($type)
                    {
                        case 1: //rset
                            $f = new RepSetForm();
                            $this->addNewSet($index,$f);
                            break;
                        case 2:
                            $f = new TimeSetForm();
                            $this->addNewSet($index,$f);
                            break;
                    }
                }
            }
        }

        parent::bind($taintedValues, $taintedFiles);
    }

    public function saveEmbeddedForms($con = null, $forms = null)
    {
        if (is_null($con))
        {
            $con = $this->getConnection();
        }

        if (is_null($forms))
        {
            $forms = $this->embeddedForms;
        }

        if(isset($forms['exercise_lists']))
        {
            $values = $this->getValues();
            foreach($this->embeddedForms['exercise_lists']->getEmbeddedForms() as $index => $setForm)
            {
                if ($values['exercise_lists'][$index]['exercise_id']) // only save sets that aren't blank
                {
                    $values['exercise_lists'][$index]['program_id'] = $this->object['id'];
                    $setForm->updateObject($values['exercise_lists'][$index]);
                    $setForm->getObject()->save();
                }
                else if(!$setForm->getObject()->isNew())
                    $setForm->getObject()->delete();
            }

            unset($this->embeddedForms['exercise_lists']);
        }

        foreach ($forms as $index => $form)
        {
            if($index != 'exercise_lists')
            {
                if ($form instanceof sfFormDoctrine)
                {
                    $form->getObject()->save($con);
                    $form->saveEmbeddedForms($con);
                }
                else
                {
                    $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
                }
            }
        }
    }

    public function updateObject($values = null)
    {
        parent::updateObject($values);

        // update user ids only for new objects
        if(!$this->object->owner_id)
            $this->object->owner_id = sfContext::getInstance()->getUser()->getId();

        if(!$this->object->creator_id)
            $this->object->creator_id = sfContext::getInstance()->getUser()->getId();

        return $this->object;
    }

    public function addNewSet($name, $form)
    {
        $this->embeddedForms['exercise_lists']->embedForm($name, $form);
        $this->embedForm('exercise_lists', $this->embeddedForms['exercise_lists']); // re-embed the form
    }
}