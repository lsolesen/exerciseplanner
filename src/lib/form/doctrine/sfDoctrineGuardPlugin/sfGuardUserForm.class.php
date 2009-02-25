<?php

/**
 * sfGuardUser form.
 *
 * @package    form
 * @subpackage sfGuardUser
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
    public function configure()
    {
        $this->setWidgets(array(
                                  'username'         => new sfWidgetFormInput(),
                                  'password'         => new sfWidgetFormInputPassword(),
                                  'confirm_password' => new sfWidgetFormInputPassword(),
                                ));

        $this->setValidators(array(
                                  'username'         => new sfValidatorString(array('max_length' => 128)),
                                  'password'         => new sfValidatorString(array('max_length' => 128, 'required' => true,'min_length'=> 6)),
                                  'confirm_password'  => new sfValidatorString(array('required' => true, 'min_length' => 6, 'max_length' => 128)),
                                ));

        $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

        $profileForm = new ProfileForm($this->object->Profile);
        unset($profileForm['id'], $profileForm['sf_guard_user_id'], $profileForm['notes']);
        $this->embedForm('Profile', $profileForm);
    }

//    public function updateObject($values)
//    {
//        parent::updateObject($values);
//    }
}
