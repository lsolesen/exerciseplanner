<?php

class sfGuardAuthActions extends BasesfGuardAuthActions
{
    public function executeSwitchLanguage(sfWebRequest $request)
    {
        $u       = $this->getUser();
        $culture = $u->getCulture();
        $url     = $u->getAttribute('url','@homepage','language');

        $u->setCulture( ($culture == 'en')?'da':'en' );

        $this->redirect($url);
    }

    public function executePassword()
    {
        if($this->getRequest()->isMethod('post'))
        {
            $form = new sfGuardUserPasswordForm();

            $form->bind($this->getRequest()->getParameter($form->getName()));

            if ($form->isValid())
            {
                $values         = $form->getValues();
                $user           = $values['username'];
                $password       = substr(md5(rand(1,999999).$user['username']),rand(1,25),5);
                $user->password = $password;
                $email          = $user->Profile['email_address'];

                $this->logMessage($password);

                // Create our connection
                $conn    = new Swift_Connection_NativeMail();
                $mailer  = new Swift($conn);
                $message = new Swift_Message( 'Password Reset' );

                $this->getRequest()->setAttribute('user',$user);
                $this->getRequest()->setAttribute('password',$password);

                $htmlBody = $this->getController()->getPresentationFor('sfGuardAuth', 'emailPasswordHtml');
                $textBody = $this->getController()->getPresentationFor('sfGuardAuth', 'emailPasswordTxt');

                $message->attach(new Swift_Message_Part($textBody));
                $message->attach(new Swift_Message_Part($htmlBody, "text/html"));
                $mailer->send($message, new Swift_Address($email,$user->Profile['first_name'].' '.$user->Profile['last_name']), new Swift_Address('nathanael@gnat.ca','Exercise Planner'));

                $user->save();
                $this->getUser()->setFlash('notice', 'A new password has been emailed to you.');
                $this->redirect('sfGuardAuth/password');
            }
            else
                $this->form = $form;

        }
        else if(!$this->getUser()->hasFlash('notice'))
             $this->form = new sfGuardUserPasswordForm();
    }

    public function executeEmailPasswordHtml()
    {
        $this->user     = $this->getRequest()->getAttribute('user');
        $this->password = $this->getRequest()->getAttribute('password');
    }

    public function executeEmailPasswordTxt()
    {
        $this->user     = $this->getRequest()->getAttribute('user');
        $this->password = $this->getRequest()->getAttribute('password');
    }

    public function executeRegister(sfWebRequest $request)
    {
        $this->form = new sfGuardUserForm();

        if($request->isMethod('post'))
            $this->processForm($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($user = $this->getUser()->getGuardUser(), sprintf('Object program does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user);

        if($request->isMethod('post'))
            $this->processForm($request, $this->form);
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()));

        if ($form->isValid())
        {
            $sf_user = $form->save();
            $this->getUser()->signIn($sf_user);
            $this->redirect('sfGuardAuth/edit?id='.$sf_user['id']);
        }
    }
}