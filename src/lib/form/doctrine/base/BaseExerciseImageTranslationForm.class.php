<?php

/**
 * ExerciseImageTranslation form base class.
 *
 * @package    form
 * @subpackage exercise_image_translation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseImageTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'caption' => new sfWidgetFormInput(),
      'lang'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorDoctrineChoice(array('model' => 'ExerciseImageTranslation', 'column' => 'id', 'required' => false)),
      'caption' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'lang'    => new sfValidatorDoctrineChoice(array('model' => 'ExerciseImageTranslation', 'column' => 'lang', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_image_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseImageTranslation';
  }

}