<?php

/**
 * MuscleTranslation form base class.
 *
 * @package    form
 * @subpackage muscle_translation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMuscleTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'insertion' => new sfWidgetFormInput(),
      'origin'    => new sfWidgetFormInput(),
      'lang'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => 'MuscleTranslation', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'insertion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'origin'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'      => new sfValidatorDoctrineChoice(array('model' => 'MuscleTranslation', 'column' => 'lang', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('muscle_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MuscleTranslation';
  }

}