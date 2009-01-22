<?php

/**
 * ProgramExercise form base class.
 *
 * @package    form
 * @subpackage program_exercise
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProgramExerciseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'program_id'      => new sfWidgetFormDoctrineSelect(array('model' => 'Program', 'add_empty' => true)),
      'exercise_set_id' => new sfWidgetFormDoctrineSelect(array('model' => 'ExerciseSet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'ProgramExercise', 'column' => 'id', 'required' => false)),
      'program_id'      => new sfValidatorDoctrineChoice(array('model' => 'Program', 'required' => false)),
      'exercise_set_id' => new sfValidatorDoctrineChoice(array('model' => 'ExerciseSet', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('program_exercise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProgramExercise';
  }

}