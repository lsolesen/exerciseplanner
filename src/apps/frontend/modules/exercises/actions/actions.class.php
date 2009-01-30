<?php

/**
 * exercises actions.
 *
 * @package    motionsplan
 * @subpackage exercises
 * @author     Nathanael D. Noblet
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class exercisesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->exercise_list = Doctrine::getTable('Exercise')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExerciseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ExerciseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($exercise = Doctrine::getTable('Exercise')->find($request->getParameter('id')), sprintf('Object exercise does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExerciseForm($exercise);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($exercise = Doctrine::getTable('Exercise')->find($request->getParameter('id')), sprintf('Object exercise does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExerciseForm($exercise);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($exercise = Doctrine::getTable('Exercise')->find($request->getParameter('id')), sprintf('Object exercise does not exist (%s).', $request->getParameter('id')));
    $exercise->delete();

    $this->redirect('exercises/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $exercise = $form->save();

      $this->redirect('exercises/edit?id='.$exercise['id']);
    }
  }
}
