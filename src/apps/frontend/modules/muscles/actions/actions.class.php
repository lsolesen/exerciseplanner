<?php

/**
 * muscles actions.
 *
 * @package    motionsplan
 * @subpackage muscles
 * @author     Nathanael D. Noblet
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class musclesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->muscle_list = Doctrine::getTable('Muscle')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MuscleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new MuscleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($muscle = Doctrine::getTable('Muscle')->find($request->getParameter('id')), sprintf('Object muscle does not exist (%s).', $request->getParameter('id')));
    $this->form = new MuscleForm($muscle);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($muscle = Doctrine::getTable('Muscle')->find($request->getParameter('id')), sprintf('Object muscle does not exist (%s).', $request->getParameter('id')));
    $this->form = new MuscleForm($muscle);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($muscle = Doctrine::getTable('Muscle')->find($request->getParameter('id')), sprintf('Object muscle does not exist (%s).', $request->getParameter('id')));
    $muscle->delete();

    $this->redirect('muscles/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $muscle = $form->save();

      $this->redirect('muscles/edit?id='.$muscle['id']);
    }
  }
}
