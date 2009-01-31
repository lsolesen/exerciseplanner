<?php

/**
 * ExerciseSet form.
 *
 * @package    form
 * @subpackage ExerciseSet
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ExerciseSetForm extends BaseExerciseSetForm
{
    public function configure()
    {
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>1)));

    }
}