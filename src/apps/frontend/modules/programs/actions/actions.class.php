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
        $u = $this->getUser();
        $this->program_list = Doctrine::getTable('Program')->getViewableQuery($u->getId(),$u->getCulture())->execute();
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
        $this->forward404Unless($program = Doctrine::getTable('Program')->loadForShow($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProgramForm($program);
    }

    public function executeShow(sfWebRequest $request)
    {
        $program = Doctrine::getTable('Program')->loadForShow($request->getParameter('id'));
        $this->forward404Unless($program, sprintf('Program does not exist (%s).', $request->getParameter('id')));

        $this->program = $program;
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
        $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));
        $this->forward404Unless($program->isOwner($this->getUser()));

        $this->form = new ProgramForm($program);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDuplicate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('get'));
        $this->forward404Unless($program = Doctrine::getTable('Program')->load($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));

        $n_program = new Program();
        $data      = $program->returnForDuplication( $this->getUser()->getId());
        $this->logMessage(print_r($data,true));
        $n_program->fromArray($data , true );
        $n_program->save();

        $this->redirect('programs/index');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Object program does not exist (%s).', $request->getParameter('id')));
        $program->delete();

        $this->redirect('programs/index');
    }

    public function executeAddSet(sfWebRequest $request)
    {
        $type = $this->getRequestParameter('t',null);

        if($type == 'rep')
        {
            $rset             = new RepSet();
            $rset->otype      = 1;

            $this->form = new RepSetForm($rset);
            $this->label = 'Rep Set';
        }
        else
        {
            $rset             = new TimeSet();
            $rset->otype      = 2;

            $this->form = new TimeSetForm($rset);
            $this->label = 'Time Set';
        }

        $this->id = rand();
    }

    public function executeRemoveSet(sfWebRequest $request)
    {
        Doctrine_Query::create()->delete()->from('ExerciseSet es')->where('es.id = ?',$request->getParameter('id'))->execute();

        return sfView::NONE;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid())
        {
            $program = $form->save();

            $sets = $request->getParameter('exercise_set');
            $this->logMessage('SETS: '.print_r($sets,true));
            $toSave = new Doctrine_Collection('ExerciseSet');

            foreach($sets['id'] as $key => $id)
            {
                if($id)
                    $rset = Doctrine::getTable('ExerciseSet')->find($id);
                else
                    $rset = new ExerciseSet();

                $rset->otype      = $sets['otype'][$key];
                $rset->program_id = $program['id'];
                $rset->exercise_id= $sets['exercise_id'][$key];
                $rset->s1         = $sets['s1'][$key];
                $rset->s2         = $sets['s2'][$key];
                $toSave[]         = $rset;
            }

            $toSave->save();

            $this->redirect('programs/edit?id='.$program['id']);
        }
    }
}
