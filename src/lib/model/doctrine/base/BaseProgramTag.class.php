<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProgramTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('program_tag');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('tag_id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'length' => '4'));
        $this->hasColumn('program_id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasOne('Program', array('local' => 'program_id',
                                       'foreign' => 'id',
                                       'onDelete' => 'CASCADE'));

        $this->hasOne('Tag', array('local' => 'tag_id',
                                   'foreign' => 'id',
                                   'onDelete' => 'CASCADE'));
    }
}