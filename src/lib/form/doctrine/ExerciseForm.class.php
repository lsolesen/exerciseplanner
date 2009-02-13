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
        unset($this['created_at'],$this['updated_at'],$this['owner_id'],$this['creator_id'],$this['tags_list']);

        $this->widgetSchema->setLabel('exercises_list','Related Exercises');
        $this->widgetSchema->setLabel('muscles_list','Related Muscles');
//        $this->widgetSchema->setLabel('tags_list','Tags');

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');
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
}