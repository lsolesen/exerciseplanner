<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tag');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 64, array('type' => 'string', 'length' => '64'));
    }

    public function setUp()
    {
        $this->hasMany('Program as Programs', array('refClass' => 'ProgramTag',
                                                    'local' => 'tag_id',
                                                    'foreign' => 'program_id'));

        $this->hasMany('Exercise', array('refClass' => 'ExerciseTag',
                                         'local' => 'tag_id',
                                         'foreign' => 'exercise_id'));

        $this->hasMany('ExerciseTag', array('local' => 'id',
                                            'foreign' => 'tag_id'));

        $this->hasMany('ProgramTag', array('local' => 'id',
                                           'foreign' => 'tag_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $i18n0 = new Doctrine_Template_I18n(array('fields' => array(0 => 'name')));
        $this->actAs($timestampable0);
        $this->actAs($i18n0);
    }
}