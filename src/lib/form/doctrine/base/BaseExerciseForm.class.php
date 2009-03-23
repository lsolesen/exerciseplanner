<?php

/**
 * Exercise form base class.
 *
 * @package    form
 * @subpackage exercise
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'creator_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'owner_id'       => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'is_shareable'   => new sfWidgetFormInputCheckbox(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'exercises_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Exercise')),
      'muscles_list'   => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Muscle')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Exercise', 'column' => 'id', 'required' => false)),
      'creator_id'     => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'owner_id'       => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'is_shareable'   => new sfValidatorBoolean(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'exercises_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
      'muscles_list'   => new sfValidatorDoctrineChoiceMany(array('model' => 'Muscle', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Exercise';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['exercises_list']))
    {
      $this->setDefault('exercises_list', $this->object->Exercises->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['muscles_list']))
    {
      $this->setDefault('muscles_list', $this->object->Muscles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveExercisesList($con);
    $this->saveMusclesList($con);
  }

  public function saveExercisesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['exercises_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Exercises', array());

    $values = $this->getValue('exercises_list');
    if (is_array($values))
    {
      $this->object->link('Exercises', $values);
    }
  }

  public function saveMusclesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['muscles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Muscles', array());

    $values = $this->getValue('muscles_list');
    if (is_array($values))
    {
      $this->object->link('Muscles', $values);
    }
  }

}