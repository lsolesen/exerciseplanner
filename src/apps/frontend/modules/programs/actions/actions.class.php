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
        $this->program_list = Doctrine_Query::create()
                                    ->select('p.*, t.name, o.username,c.username,COUNT(s.id) as num_exercises,*')
                                    ->from('Program p')
                                    ->leftJoin('p.Translation t WITH t.lang = ?',$this->getUser()->getCulture())
                                    ->leftJoin('p.Owner o')
                                    ->leftJoin('p.Creator c')
                                    ->leftJoin('p.Sets s')
                                    ->groupBy('p.id')
                                    ->execute();
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
        $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProgramForm($program);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
        $this->forward404Unless($program = Doctrine::getTable('Program')->find($request->getParameter('id')), sprintf('Program does not exist (%s).', $request->getParameter('id')));
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
