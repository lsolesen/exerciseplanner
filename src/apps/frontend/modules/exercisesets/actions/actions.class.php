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
        $this->exercise_set_list = Doctrine_Query::create()->from('ExerciseSet es')->orderBy('es.otype')->execute();
        $this->labels = array(1=> array('otype'=>'Rep Set','s1'=>'Weight','i1'=>'Reps'), 2 => array('otype'=>'Time Set','s1'=>'Time','i1'=>'Misc'));
    }

    public function executeNewRep(sfWebRequest $request)
    {
        $rset = new RepSet();
        $rset->otype = 1;
        $this->form = new RepSetForm($rset);
        $this->label = 'Rep Set';
        $this->setTemplate('new');
    }

    public function executeNewTime(sfWebRequest $request)
    {
        $tset = new TimeSet();
        $tset->otype = 2;
        $this->form = new TimeSetForm($tset);
        $this->label = 'Time Set';
        $this->setTemplate('new');
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('post'));

        $exercise_set = $request->getParameter('exercise_set');
        $this->logMessage('OTYPE: '.$exercise_set['otype']);

        switch($exercise_set['otype'])
        {
            case 1: // rep set
                $this->label = 'Rep Set';
                $this->form = new RepSetForm();
                break;
            case 2: // time set
                $this->label = 'Time Set';
                $this->form = new TimeSetForm();
                break;

            default:
                $this->label = 'Error';
                $this->form = new ExerciseSetForm();
                break;
        }

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($exercise_set = Doctrine::getTable('ExerciseSet')->find($request->getParameter('id')), sprintf('Object exercise_set does not exist (%s).', $request->getParameter('id')));
        if($exercise_set instanceof RepSet)
        {
            $this->label = 'Rep Set';
            $this->form = new RepSetForm($exercise_set);
        }
        else if($exercise_set instanceof TimeSet)
        {
            $this->label = 'Time Set';
            $this->form = new TimeSetForm($exercise_set);
        }
        else
        $this->form = new ExerciseSetForm($exercise_set);
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
