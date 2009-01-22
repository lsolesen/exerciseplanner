<?php

/**
 * Muscle form base class.
 *
 * @package    form
 * @subpackage muscle
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMuscleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'insertio'      => new sfWidgetFormInput(),
      'origio'        => new sfWidgetFormInput(),
      'exercise_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => 'Muscle', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'insertio'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'origio'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'exercise_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('muscle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Muscle';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['exercise_list']))
    {
      $this->setDefault('exercise_list', $this->object->Exercise->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveExerciseList($con);
  }

  public function saveExerciseList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['exercise_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Exercise', array());

    $values = $this->getValue('exercise_list');
    if (is_array($values))
    {
      $this->object->link('Exercise', $values);
    }
  }

}