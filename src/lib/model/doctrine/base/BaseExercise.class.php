<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseExercise extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('exercises');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => true, 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('creator_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('owner_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('name', 'string', 30, array('type' => 'string', 'length' => '30'));
        $this->hasColumn('description', 'string', 4000, array('type' => 'string', 'length' => '4000'));
        $this->hasColumn('video', 'string', 255, array('type' => 'string', 'length' => '255'));
        $this->hasColumn('is_shareable', 'boolean', null, array('type' => 'boolean', 'default' => false));
    }

    public function setUp()
    {
        $this->hasOne('sfGuardUser as Creator', array('local' => 'creator_id',
                                                      'foreign' => 'id',
                                                      'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as Owner', array('local' => 'owner_id',
                                                    'foreign' => 'id',
                                                    'onDelete' => 'CASCADE'));

        $this->hasMany('Exercise as Exercises', array('refClass' => 'ExerciseLink',
                                                      'local' => 'exercise_id',
                                                      'foreign' => 'related_exercise_id'));

        $this->hasMany('Muscle as Muscles', array('refClass' => 'ExerciseMuscle',
                                                  'local' => 'exercise_id',
                                                  'foreign' => 'muscle_id'));

        $this->hasMany('Tag as Tags', array('refClass' => 'ExerciseTag',
                                            'local' => 'exercise_id',
                                            'foreign' => 'tag_id'));

        $this->hasMany('ExerciseSet as ExerciseSets', array('local' => 'id',
                                                            'foreign' => 'exercise_id'));

        $this->hasMany('ExerciseLink', array('local' => 'id',
                                             'foreign' => 'exercise_id'));

        $this->hasMany('ExerciseImage as Images', array('local' => 'id',
                                                        'foreign' => 'exercise_id'));

        $this->hasMany('ExerciseTag', array('local' => 'id',
                                            'foreign' => 'exercise_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $i18n0 = new Doctrine_Template_I18n(array('fields' => array(0 => 'name', 1 => 'description', 2 => 'video')));
        $this->actAs($timestampable0);
        $this->actAs($i18n0);
    }
}