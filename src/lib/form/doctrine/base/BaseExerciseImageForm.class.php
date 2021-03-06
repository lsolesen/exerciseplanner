<?php

/**
 * ExerciseImage form base class.
 *
 * @package    form
 * @subpackage exercise_image
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseImageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'exercise_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
      'filename'    => new sfWidgetFormInput(),
      'width'       => new sfWidgetFormInput(),
      'height'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'ExerciseImage', 'column' => 'id', 'required' => false)),
      'exercise_id' => new sfValidatorDoctrineChoice(array('model' => 'Exercise', 'required' => false)),
      'filename'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'width'       => new sfValidatorInteger(array('required' => false)),
      'height'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseImage';
  }

}