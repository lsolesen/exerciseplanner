<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseImage filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseImage *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseImageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'owner_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
      'filename' => new sfWidgetFormFilterInput(),
      'width'    => new sfWidgetFormFilterInput(),
      'height'   => new sfWidgetFormFilterInput(),
      'caption'  => new sfWidgetFormFilterInput(),
      'otype'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'owner_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Exercise', 'column' => 'id')),
      'filename' => new sfValidatorPass(array('required' => false)),
      'width'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'caption'  => new sfValidatorPass(array('required' => false)),
      'otype'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('exercise_image_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseImage';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'owner_id' => 'ForeignKey',
      'filename' => 'Text',
      'width'    => 'Number',
      'height'   => 'Number',
      'caption'  => 'Text',
      'otype'    => 'Number',
    );
  }
}