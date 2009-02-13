<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Tag filter form base class.
 *
 * @package    filters
 * @subpackage Tag *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'programs_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Program')),
      'exercise_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Exercise')),
    ));

    $this->setValidators(array(
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'programs_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Program', 'required' => false)),
      'exercise_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Exercise', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addProgramsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ProgramTag ProgramTag')
          ->andWhereIn('ProgramTag.program_id', $values);
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

    $query->leftJoin('r.ExerciseTag ExerciseTag')
          ->andWhereIn('ExerciseTag.exercise_id', $values);
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'programs_list' => 'ManyKey',
      'exercise_list' => 'ManyKey',
    );
  }
}