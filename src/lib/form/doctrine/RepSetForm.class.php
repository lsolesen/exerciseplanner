<?php

/**
 * RepSet form.
 *
 * @package    form
 * @subpackage RepSet
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class RepSetForm extends BaseRepSetForm
{
    public function configure()
    {
        unset($this['program_id']);
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>1)));
//        $this->setWidget('program_id',new sfWidgetFormInputHidden());
        $this->widgetSchema->setLabels(array(
                                        'exercise_id'=>'Exercise',
                                        's1'   => 'Weight',
                                        's2'   => 'Number of Reps',
        ));
        $this->widgetSchema->setNameFormat('exercise_set[%s][]');
    }
}