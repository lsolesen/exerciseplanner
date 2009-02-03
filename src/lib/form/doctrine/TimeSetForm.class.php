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
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>2)));
        $this->widgetSchema->setLabels(array(
                                        's1'   => 'Misc',
                                        'i1'   => 'Time',
                                        'en'   => 'English',
                                        'da'   => 'Danish',
                                        ));
        $this->widgetSchema->setNameFormat('exercise_set[%s]');

        $this->embedI18n(array('en','da'));
    }
}