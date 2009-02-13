<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ProgramTag filter form base class.
 *
 * @package    filters
 * @subpackage ProgramTag *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseProgramTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true)),
      'program_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Program', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tag_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Tag', 'column' => 'id')),
      'program_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Program', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('program_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProgramTag';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'tag_id'     => 'ForeignKey',
      'program_id' => 'ForeignKey',
    );
  }
}