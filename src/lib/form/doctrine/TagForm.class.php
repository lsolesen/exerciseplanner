<?php

/**
 * Tag form.
 *
 * @package    form
 * @subpackage Tag
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TagForm extends BaseTagForm
{
    public function configure()
    {
        unset($this['created_at'],$this['updated_at'],$this['exercise_list'],$this['programs_list']);

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');
    }
}