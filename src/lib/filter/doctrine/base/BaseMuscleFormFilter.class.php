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
      'name'          => new sfWidgetFormFilterInput(),
      'insertio'      => new sfWidgetFormFilterInput(),
      'origio'        => new sfWidgetFormFilterInput(),
      'exercise_list' => new sfWidgetFormDoctrineSelectMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'insertio'      => new sfValidatorPass(array('required' => false)),
      'origio'        => new sfValidatorPass(array('required' => false)),
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
      'name'          => 'Text',
      'insertio'      => 'Text',
      'origio'        => 'Text',
      'exercise_list' => 'ManyKey',
    );
  }
}