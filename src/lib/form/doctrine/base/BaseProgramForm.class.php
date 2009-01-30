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
      'id'               => new sfWidgetFormInputHidden(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineSelect(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Program', 'column' => 'id', 'required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
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