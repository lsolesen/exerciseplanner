<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Exercise filter form base class.
 *
 * @package    filters
 * @subpackage Exercise *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExerciseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'exercise_list' => new sfWidgetFormDoctrineSelectMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'exercise_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercise_filters[%s]');

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

    $query->leftJoin('r.ExerciseLink ExerciseLink')
          ->andWhereIn('ExerciseLink.related_exercise_id', $values);
  }

  public function getModelName()
  {
    return 'Exercise';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'exercise_list' => 'ManyKey',
    );
  }
}