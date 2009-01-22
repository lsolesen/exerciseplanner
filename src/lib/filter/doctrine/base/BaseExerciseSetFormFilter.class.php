<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseSet filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseSet *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseSetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'otype' => new sfWidgetFormFilterInput(),
      's1'    => new sfWidgetFormFilterInput(),
      'i1'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'otype' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      's1'    => new sfValidatorPass(array('required' => false)),
      'i1'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('exercise_set_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseSet';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'otype' => 'Number',
      's1'    => 'Text',
      'i1'    => 'Number',
    );
  }
}