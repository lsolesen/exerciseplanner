<?php

/**
 * Tag form base class.
 *
 * @package    form
 * @subpackage tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'programs_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Program')),
      'exercise_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => 'Tag', 'column' => 'id', 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'programs_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Program', 'required' => false)),
      'exercise_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['programs_list']))
    {
      $this->setDefault('programs_list', $this->object->Programs->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['exercise_list']))
    {
      $this->setDefault('exercise_list', $this->object->Exercise->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveProgramsList($con);
    $this->saveExerciseList($con);
  }

  public function saveProgramsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['programs_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Programs', array());

    $values = $this->getValue('programs_list');
    if (is_array($values))
    {
      $this->object->link('Programs', $values);
    }
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