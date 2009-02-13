<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RepSet filter form base class.
 *
 * @package    filters
 * @subpackage RepSet *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRepSetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'exercise_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
      'program_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'Program', 'add_empty' => true)),
      's1'          => new sfWidgetFormFilterInput(),
      's2'          => new sfWidgetFormFilterInput(),
      'otype'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exercise_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Exercise', 'column' => 'id')),
      'program_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Program', 'column' => 'id')),
      's1'          => new sfValidatorPass(array('required' => false)),
      's2'          => new sfValidatorPass(array('required' => false)),
      'otype'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('rep_set_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepSet';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'exercise_id' => 'ForeignKey',
      'program_id'  => 'ForeignKey',
      's1'          => 'Text',
      's2'          => 'Text',
      'otype'       => 'Number',
    );
  }
}