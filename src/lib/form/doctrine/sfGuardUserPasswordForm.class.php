<?php

/**
 * sfGuardUser form.
 *
 * @package    form
 * @subpackage sfGuardUser
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfGuardUserPasswordForm extends PluginsfGuardUserForm
{
    public function configure()
    {
        $this->setWidgets(array('username' => new sfWidgetFormInput()));
        $this->setValidators(array('username' => new sfGuardValidatorUserForPassword()));

        $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    }
}
