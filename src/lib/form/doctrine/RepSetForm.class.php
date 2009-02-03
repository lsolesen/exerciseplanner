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
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>1)));
        $this->widgetSchema->setLabels(array(
                                        's1'   => 'Weight',
                                        'i1'   => 'Number of Reps',
                                        'en'   => 'English',
                                        'da'   => 'Danish',
                                        ));
        $this->widgetSchema->setNameFormat('exercise_set[%s]');

        $this->embedI18n(array('en','da'));
    }
}