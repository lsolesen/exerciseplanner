<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseMuscle filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseMuscle *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseMuscleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'exercise_id' => new sfWidgetFormFilterInput(),
      'muscle_id'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exercise_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'muscle_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('exercise_muscle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseMuscle';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'exercise_id' => 'Number',
      'muscle_id'   => 'Number',
    );
  }
}