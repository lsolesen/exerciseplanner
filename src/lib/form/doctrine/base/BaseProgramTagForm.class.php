<?php

/**
 * ProgramTag form base class.
 *
 * @package    form
 * @subpackage program_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProgramTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'tag_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true)),
      'program_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Program', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'ProgramTag', 'column' => 'id', 'required' => false)),
      'tag_id'     => new sfValidatorDoctrineChoice(array('model' => 'Tag', 'required' => false)),
      'program_id' => new sfValidatorDoctrineChoice(array('model' => 'Program', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('program_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProgramTag';
  }

}