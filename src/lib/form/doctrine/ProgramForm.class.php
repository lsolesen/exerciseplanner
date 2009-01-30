<?php

/**
 * Program form.
 *
 * @package    form
 * @subpackage Program
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProgramForm extends BaseProgramForm
{
    public function configure()
    {
        unset($this['created_at'],$this['updated_at'],$this['sf_guard_user_id']);

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');

    }

    public function updateObject($values = null)
    {
        parent::updateObject($values);
        $this->object->sf_guard_user_id = sfContext::getInstance()->getUser()->getId();
        return $this->object;
    }
}