<?php

class myUser extends sfGuardSecurityUser
{
    private $user = null;

    public function getGuardUser()
    {
        if (!$this->user && $id = $this->getAttribute('user_id', null, 'sfGuardSecurityUser'))
        {
            $this->user = Doctrine_Query::create()->from('sfGuardUser su')->innerJoin('su.Profile p')->where('su.id = ?',$id)->fetchOne();

            if (!$this->user)
            {
                // the user does not exist anymore in the database
                $this->signOut();

                throw new sfException('The user does not exist anymore in the database.');
            }
        }

        return $this->user;
    }
}
