<?php

/**
 * TimeSet form.
 *
 * @package    form
 * @subpackage TimeSet
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TimeSetForm extends BaseTimeSetForm
{
    public function configure()
    {
        unset($this['program_id']);
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>2)));
//        $this->setWidget('program_id',new sfWidgetFormInputHidden());

        $this->widgetSchema->setLabels(array(
                                        'exercise_id'=>'Exercise',
                                        's1'   => 'Misc',
                                        's2'   => 'Time',
                                        ));
        $this->widgetSchema->setNameFormat('exercise_set[%s][]');
    }
}