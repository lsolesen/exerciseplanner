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
    unset($this['created_at'],$this['updated_at']);

    $this->widgetSchema->setLabel('exercises_list','Related Exercises');
    $this->widgetSchema->setLabel('muscles_list','Related Muscles');

    $this->embedI18n(array('en','da'));
  }
}