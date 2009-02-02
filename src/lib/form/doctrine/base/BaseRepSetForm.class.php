<?php

/**
 * RepSet form base class.
 *
 * @package    form
 * @subpackage rep_set
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepSetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'otype'        => new sfWidgetFormInput(),
      's1'           => new sfWidgetFormInput(),
      'i1'           => new sfWidgetFormInput(),
      'program_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Program')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => 'RepSet', 'column' => 'id', 'required' => false)),
      'otype'        => new sfValidatorInteger(array('required' => false)),
      's1'           => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'i1'           => new sfValidatorInteger(array('required' => false)),
      'program_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Program', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_set[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepSet';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['program_list']))
    {
      $this->setDefault('program_list', $this->object->Program->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveProgramList($con);
  }

  public function saveProgramList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['program_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Program', array());

    $values = $this->getValue('program_list');
    if (is_array($values))
    {
      $this->object->link('Program', $values);
    }
  }

}