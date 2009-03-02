<?php

/**
 * ExerciseTag form base class.
 *
 * @package    form
 * @subpackage exercise_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'tag_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true)),
      'exercise_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Exercise', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'ExerciseTag', 'column' => 'id', 'required' => false)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('model' => 'Tag', 'required' => false)),
      'exercise_id' => new sfValidatorDoctrineChoice(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseTag';
  }

}