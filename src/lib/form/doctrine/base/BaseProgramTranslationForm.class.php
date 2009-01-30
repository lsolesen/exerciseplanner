<?php

/**
 * ProgramTranslation form base class.
 *
 * @package    form
 * @subpackage program_translation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProgramTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'name'  => new sfWidgetFormInput(),
      'notes' => new sfWidgetFormTextarea(),
      'lang'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorDoctrineChoice(array('model' => 'ProgramTranslation', 'column' => 'id', 'required' => false)),
      'name'  => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'notes' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'lang'  => new sfValidatorDoctrineChoice(array('model' => 'ProgramTranslation', 'column' => 'lang', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('program_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProgramTranslation';
  }

}