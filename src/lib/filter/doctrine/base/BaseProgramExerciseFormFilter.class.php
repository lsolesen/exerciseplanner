<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ProgramExercise filter form base class.
 *
 * @package    filters
 * @subpackage ProgramExercise *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseProgramExerciseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'program_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Program', 'add_empty' => true)),
      'exercise_set_id' => new sfWidgetFormDoctrineChoice(array('model' => 'ExerciseSet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'program_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Program', 'column' => 'id')),
      'exercise_set_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ExerciseSet', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('program_exercise_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProgramExercise';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'program_id'      => 'ForeignKey',
      'exercise_set_id' => 'ForeignKey',
    );
  }
}