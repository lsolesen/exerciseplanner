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