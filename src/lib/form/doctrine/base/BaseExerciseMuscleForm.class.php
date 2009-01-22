<?php

/**
 * ExerciseMuscle form base class.
 *
 * @package    form
 * @subpackage exercise_muscle
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseMuscleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'exercise_id' => new sfWidgetFormInput(),
      'muscle_id'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'ExerciseMuscle', 'column' => 'id', 'required' => false)),
      'exercise_id' => new sfValidatorInteger(array('required' => false)),
      'muscle_id'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_muscle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseMuscle';
  }

}