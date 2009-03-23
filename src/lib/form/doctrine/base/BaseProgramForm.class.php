<?php

/**
 * Program form base class.
 *
 * @package    form
 * @subpackage program
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProgramForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'creator_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'owner_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'is_shareable' => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => 'Program', 'column' => 'id', 'required' => false)),
      'creator_id'   => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'owner_id'     => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'is_shareable' => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('program[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Program';
  }

}