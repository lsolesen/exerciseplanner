<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseTag filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseTag *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true)),
      'exercise_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tag_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Tag', 'column' => 'id')),
      'exercise_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Exercise', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('exercise_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseTag';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'tag_id'      => 'ForeignKey',
      'exercise_id' => 'ForeignKey',
    );
  }
}