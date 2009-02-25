<?php
class sfGuardValidatorUserForPassword extends sfValidatorBase
{
    public function configure($options = array(), $messages = array())
    {
        $this->addOption('username_field', 'username');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'The username is invalid.');
    }

    protected function doClean($values)
    {
        $user = Doctrine::getTable('sfGuardUser')->getByUsername($values);

        // user exists?
        if ($user)
            return $user;

        if ($this->getOption('throw_global_error'))
            throw new sfValidatorError($this, 'invalid');

        throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
    }
}