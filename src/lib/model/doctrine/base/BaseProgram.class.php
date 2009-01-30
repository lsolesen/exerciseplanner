<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProgram extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('program');
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('sf_guard_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('name', 'string', 32, array('type' => 'string', 'length' => '32'));
    $this->hasColumn('notes', 'string', 4000, array('type' => 'string', 'length' => '4000'));
  }

  public function setUp()
  {
    $this->hasOne('sfGuardUser as User', array('local' => 'sf_guard_user_id',
                                               'foreign' => 'id',
                                               'onDelete' => 'CASCADE'));

    $this->hasMany('ProgramExercise', array('local' => 'id',
                                            'foreign' => 'program_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $i18n0 = new Doctrine_Template_I18n(array('fields' => array(0 => 'name', 1 => 'notes')));
    $this->actAs($timestampable0);
    $this->actAs($i18n0);
  }
}