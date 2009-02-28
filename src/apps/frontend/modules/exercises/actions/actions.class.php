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
        $u = $this->getUser();
        $this->exercise_list = Doctrine::getTable('Exercise')->getViewableQuery($u->getId(),$u->getCulture())->execute();
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

    public function executeShow(sfWebRequest $request)
    {
        $exercise = Doctrine::getTable('Exercise')->find($request->getParameter('id'));

        $this->forward404Unless($exercise);
        $this->exercise = $exercise;
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

    public function executeDuplicate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('get'));
        $this->forward404Unless($exercise = Doctrine::getTable('Exercise')->find($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));

        $n_exercise = new Exercise();
        $data       = $exercise->returnForDuplication( $this->getUser()->getId() );

        $n_exercise->fromArray($data , true );
        $n_exercise->save();

        $this->redirect('programs/index');
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
        $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $exercise = $form->save();

            $this->redirect('exercises/show?id='.$exercise['id']);
        }
    }

    public function executeAddImage(sfWebRequest $request)
    {
        $embedName = 'new_image_'.rand();
        $form      = new ExerciseImageForm();
        $eform     = new ExerciseForm();
        $eform->addNewImage($embedName,$form);

        // we can't use the $this->form form because the output escaper causes it to become a string and thus useless in the actual action.
        $this->setVar('form',$eform['images'][$embedName],true);
        $this->id   = $embedName;
    }

    public function executeRemoveImage(sfWebRequest $request)
    {
        Doctrine_Query::create()->delete()->from('ExerciseImage es')->where('es.id = ?',$request->getParameter('id'))->execute();

        return sfView::NONE;
    }
}
