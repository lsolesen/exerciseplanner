<?php

/**
 * ExerciseLink form base class.
 *
 * @package    form
 * @subpackage exercise_link
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseLinkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'exercise_id'         => new sfWidgetFormDoctrineSelect(array('model' => 'Exercise', 'add_empty' => true)),
      'related_exercise_id' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => 'ExerciseLink', 'column' => 'id', 'required' => false)),
      'exercise_id'         => new sfValidatorDoctrineChoice(array('model' => 'Exercise', 'required' => false)),
      'related_exercise_id' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseLink';
  }

}