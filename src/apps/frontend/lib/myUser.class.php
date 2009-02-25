<?php

class myUser extends sfGuardSecurityUser
{
    private $user = null;

    public function getGuardUser()
    {
        if (!$this->user && $id = $this->getAttribute('user_id', null, 'sfGuardSecurityUser'))
        {
            $q = Doctrine_Query::create()->from('sfGuardUser su')->innerJoin('su.Profile p')->where('su.id = ?',$id);
            $this->user = $q->fetchOne();

            if (!$this->user)
            {
                // the user does not exist anymore in the database
                $this->signOut();

                throw new sfException('The user does not exist anymore in the database. DQL '.$q->getSql().' Params: '.print_r($q->getParams(),true));
            }
        }

        return $this->user;
    }

    public function getId()
    {
        return $this->getAttribute('user_id', null, 'sfGuardSecurityUser');
    }
}
