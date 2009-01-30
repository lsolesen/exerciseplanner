<?php

/**
 * programs actions.
 *
 * @package    motionsplan
 * @subpackage programs
 * @author     Nathanael D. Noblet
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class programsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->program_list = Doctrine_Query::create()->from('Program p')->leftJoin('p.Translation t')->leftJoin('p.User u')->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProgramForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ProgramForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Object program does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProgramForm($program);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Object program does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProgramForm($program);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Object program does not exist (%s).', $request->getParameter('id')));
    $program->delete();

    $this->redirect('programs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $program = $form->save();

      $this->redirect('programs/edit?id='.$program['id']);
    }
  }
}
