<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Muscle filter form base class.
 *
 * @package    filters
 * @subpackage Muscle *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMuscleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'image'         => new sfWidgetFormFilterInput(),
      'image_width'   => new sfWidgetFormFilterInput(),
      'image_height'  => new sfWidgetFormFilterInput(),
      'exercise_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'image'         => new sfValidatorPass(array('required' => false)),
      'image_width'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_height'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'exercise_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('muscle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addExerciseListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ExerciseMuscle ExerciseMuscle')
          ->andWhereIn('ExerciseMuscle.exercise_id', $values);
  }

  public function getModelName()
  {
    return 'Muscle';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'image'         => 'Text',
      'image_width'   => 'Number',
      'image_height'  => 'Number',
      'exercise_list' => 'ManyKey',
    );
  }
}