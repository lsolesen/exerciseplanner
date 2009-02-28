<?php

/**
 * Exercise form.
 *
 * @package    form
 * @subpackage Exercise
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ExerciseForm extends BaseExerciseForm
{
    public function configure()
    {
        unset($this['created_at'],$this['updated_at'],$this['owner_id'],$this['creator_id'],$this['tags_list'],$this['id']);

        $this->widgetSchema->setLabel('exercises_list','Related Exercises');
        $this->widgetSchema->setLabel('muscles_list','Related Muscles');
        //        $this->widgetSchema->setLabel('tags_list','Tags');

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');

        $embeddedForm = new sfForm();
        foreach($this->getObject()->getImages() as $image)
        {
            $embeddedForm->embedForm('existing_image_'.$image->getId(), new ExerciseImageForm($image));
        }

        $this->embedForm('images', $embeddedForm);

    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        if(isset($taintedValues['images']))
        {
            foreach($taintedValues['images'] as $index => $set)
            {
                if (!isset($this['images'][$index]))
                {
                    $f = new ExerciseImageForm();
                    $this->addNewImage($index,$f);
                }
            }
        }

        $ret = parent::bind($taintedValues, $taintedFiles);

        foreach ($this->embeddedForms['images'] as $name => $form)
        {
            sfContext::getInstance()->getLogger()->log(__FUNCTION__.' isBound() '.(($this->embeddedForms['images'][$name]->isBound) ? 'true':'false').' isset: '.((isset($this->embeddedForms['images'][$name]->values['filename']) ? 'true':'false')));

            $this->embeddedForms['images'][$name]->isBound = true;
            $this->embeddedForms['images'][$name]->values  = $this->values['images'][$name];

            sfContext::getInstance()->getLogger()->log(__FUNCTION__.' isBound() '.(($this->embeddedForms['images'][$name]->isBound) ? 'true':'false').' isset: '.((isset($this->embeddedForms['images'][$name]->values['filename']) ? 'true':'false')));

        }

        return $ret;
    }

    public function updateObject($values = null)
    {
        parent::updateObject($values);

        if(!$this->object->owner_id)
        $this->object->owner_id = sfContext::getInstance()->getUser()->getId();

        if(!$this->object->creator_id)
        $this->object->creator_id = sfContext::getInstance()->getUser()->getId();

        return $this->object;
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

        if(isset($forms['images']))
        {
            $values = $this->getValues();
            foreach($this->embeddedForms['images']->getEmbeddedForms() as $index => $imageForm)
            {
                if ($values['images'][$index]['caption']) // only save sets that aren't blank
                {
                    $values['images'][$index]['owner_id'] = $this->object['id'];
                    $imageForm->updateObject($values['images'][$index]);
                    $imageForm->save();
                }
                else if(!$imageForm->getObject()->isNew())
                $imageForm->getObject()->delete();
            }

            unset($this->embeddedForms['images']);
        }

        foreach ($forms as $index => $form)
        {
            if($index != 'images')
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

    public function addNewImage($name, $form)
    {
        $this->embeddedForms['images']->embedForm($name, $form);
        $this->embedForm('images', $this->embeddedForms['images']); // re-embed the form
    }
}