<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * MuscleTranslation filter form base class.
 *
 * @package    filters
 * @subpackage MuscleTranslation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMuscleTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(),
      'insertion' => new sfWidgetFormFilterInput(),
      'origin'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'insertion' => new sfValidatorPass(array('required' => false)),
      'origin'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('muscle_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MuscleTranslation';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'insertion' => 'Text',
      'origin'    => 'Text',
      'lang'      => 'Text',
    );
  }
}