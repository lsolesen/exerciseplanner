<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExerciseImageTranslation filter form base class.
 *
 * @package    filters
 * @subpackage ExerciseImageTranslation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseImageTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'caption' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'caption' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_image_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExerciseImageTranslation';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'caption' => 'Text',
      'lang'    => 'Text',
    );
  }
}