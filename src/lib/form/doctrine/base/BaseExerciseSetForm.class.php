<?php

/**
 * ExerciseSet form base class.
 *
 * @package    form
 * @subpackage exercise_set
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExerciseSetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'otype' => new sfWidgetFormInput(),
      's1'    => new sfWidgetFormInput(),
      'i1'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorDoctrineChoice(array('model' => 'ExerciseSet', 'column' => 'id', 'required' => false)),
      'otype' => new sfValidatorInteger(array('required' => false)),
      's1'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'i1'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_set[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseSet';
  }

}