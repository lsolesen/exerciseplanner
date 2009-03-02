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
    private $max_images = 4;
    public function configure()
    {
        //        $max_images = 4;
        unset($this['created_at'],$this['updated_at'],$this['owner_id'],$this['creator_id'],$this['tags_list'],$this['id']);

        $this->widgetSchema->setLabel('exercises_list','Related Exercises');
        $this->widgetSchema->setLabel('muscles_list','Related Muscles');
        //        $this->widgetSchema->setLabel('tags_list','Tags');

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');

        $x = 1;
        foreach($this->getObject()->getImages() as $image)
        {
            $this->embedForm('image_'.$x, new ExerciseImageForm($image));
            $x++;
        }

        for( ;$x <= $this->max_images; $x++)
        {
            $this->embedForm('image_'.$x, new ExerciseImageForm());
        }
    }

    public function getMaxImages()
    {
        return $this->max_images;
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        parent::bind($taintedValues,$taintedFiles);
        if(empty($this->values))
            sfContext::getInstance()->getLogger()->log('ERROR: '.$this->errorSchema->getMessage());

        foreach ($this->embeddedForms as $name => $form)
        {
            $this->embeddedForms[$name]->isBound = true;
            $this->embeddedForms[$name]->values = $this->values[$name];
        }
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

        $values = $this->getValues();

        foreach($forms as $name => $form)
        {
//            sfContext::getInstance()->getLogger()->log(__FUNCTION__.' Form: '.$name);
            if(strpos($name,'image_') !== false)
            {
//                sfContext::getInstance()->getLogger()->log(__FUNCTION__.' IS IMAGE TYPE: '.$name);
                if ($values[$name]['en']['caption']) // only save sets that aren't blank
                {
//                    sfContext::getInstance()->getLogger()->log(__FUNCTION__.' HAS CAPTION: '.$name);
                    $form->getObject()->exercise_id = $this->object['id'];
                    $form->getObject()->save($con);
                    $form->saveEmbeddedForms($con);
                }
                else if(!$form->getObject()->isNew())
                    $form->getObject()->delete();
            }
            else if ($form instanceof sfFormDoctrine)
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