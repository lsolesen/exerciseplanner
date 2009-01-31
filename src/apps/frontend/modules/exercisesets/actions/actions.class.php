<?php

/**
 * exercisesets actions.
 *
 * @package    motionsplan
 * @subpackage exercisesets
 * @author     Nathanael Noblet
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class exercisesetsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->exercise_set_list = Doctrine::getTable('ExerciseSet')
      ->createQuery('a')
      ->execute();
  }

  public function executeNewRep(sfWebRequest $request)
  {
    $this->form = new RepSetForm();
    $this->setTemplate('new');
  }

  public function executeNewTime(sfWebRequest $request)
  {
    $this->form = new TimeSetForm();
    $this->setTemplate('new');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExerciseSetForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ExerciseSetForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($exercise_set = Doctrine::getTable('ExerciseSet')->find($request->getParameter('id')), sprintf('Object exercise_set does not exist (%s).', $request->getParameter('id')));
    if($exercise_set instanceof RepSet)
        $this->form = new RepSetForm($exercise_set);
    else if($exercise_set instanceof TimeSet)
        $this->form = new TimeSetForm($exercise_set);
    else
        $this->form = new ExerciseSetForm($exercise_set);

    $this->logMessage('CLASS: '.get_class($exercise_set));
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($exercise_set = Doctrine::getTable('ExerciseSet')->find($request->getParameter('id')), sprintf('Object exercise_set does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExerciseSetForm($exercise_set);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($exercise_set = Doctrine::getTable('ExerciseSet')->find($request->getParameter('id')), sprintf('Object exercise_set does not exist (%s).', $request->getParameter('id')));
    $exercise_set->delete();

    $this->redirect('exercisesets/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $exercise_set = $form->save();

      $this->redirect('exercisesets/edit?id='.$exercise_set['id']);
    }
  }
}
