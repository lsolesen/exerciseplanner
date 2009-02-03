<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RepSet filter form base class.
 *
 * @package    filters
 * @subpackage RepSet *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRepSetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      's1'           => new sfWidgetFormFilterInput(),
      'i1'           => new sfWidgetFormFilterInput(),
      'otype'        => new sfWidgetFormFilterInput(),
      'program_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Program')),
    ));

    $this->setValidators(array(
      's1'           => new sfValidatorPass(array('required' => false)),
      'i1'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'otype'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'program_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Program', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_set_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addProgramListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ProgramExercise ProgramExercise')
          ->andWhereIn('ProgramExercise.program_id', $values);
  }

  public function getModelName()
  {
    return 'RepSet';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      's1'           => 'Text',
      'i1'           => 'Number',
      'otype'        => 'Number',
      'program_list' => 'ManyKey',
    );
  }
}