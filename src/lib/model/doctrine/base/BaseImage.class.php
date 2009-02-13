<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseImage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('images');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('owner_id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'length' => '4'));
        $this->hasColumn('filename', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('width', 'integer', 3, array('type' => 'integer', 'unsigned' => true, 'length' => '3'));
        $this->hasColumn('height', 'integer', 3, array('type' => 'integer', 'unsigned' => true, 'length' => '3'));
        $this->hasColumn('caption', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('otype', 'integer', 1, array('type' => 'integer', 'unsigned' => true, 'length' => '1'));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_ALL ^ Doctrine::EXPORT_CONSTRAINTS);

        $this->setSubClasses(array('ExerciseImage' => array('otype' => '1')));
    }

}