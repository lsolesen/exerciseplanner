<?php
class gsShareableListener extends Doctrine_Record_Listener
{
    protected $_options = array();

    /**
     * __construct
     *
     * @param string $options
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Implement preDqlDelete() hook and add the is_shareable to all queries for which this model
     * is being used in.
     *
     * @param Doctrine_Event $event
     * @return void
     */
    public function preDqlSelect(Doctrine_Event $event)
    {
        $query  = $event->getQuery();
        $params = $event->getParams();
        $class  = get_class($event->getInvoker());
        $sql    = ($params['alias'] == $class) ? 'FROM '.$class : 'FROM '.$class.' '.$params['alias'] ;

        if(!$this->contains($sql,$query))
            return;

        $ofield = $params['alias'] . '.' . $this->_options['owner'];
        $sfield = $params['alias'] . '.' . $this->_options['share'];
        $u_id   = sfContext::getInstance()->getUser()->getId();

        if ( ! $query->contains($ofield) && !$query->contains($sfield))
            $query->addWhere(' ('. $ofield . ' = ? ) OR ( '.$sfield.' = ?)', array($u_id,true));
    }

    protected function contains($crit, $query)
    {
        return (strpos($query->getDql(),$crit) !== false);
    }
}