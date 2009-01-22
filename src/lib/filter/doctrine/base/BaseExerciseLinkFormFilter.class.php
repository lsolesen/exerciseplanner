<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseLink filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseLink *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseLinkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'exercise_id'         => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
      'related_exercise_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exercise_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Exercise', 'column' => 'id')),
      'related_exercise_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('exercise_link_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseLink';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'exercise_id'         => 'ForeignKey',
      'related_exercise_id' => 'Number',
    );
  }
}