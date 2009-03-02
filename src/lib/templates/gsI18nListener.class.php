<?php
class gsI18nListener extends Doctrine_Record_Listener
{
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
        $sql    = $params['alias'].'.Translation';

        if($this->contains($sql,$query))
            return;

        $nalias = $params['alias'].'I18n';
        $query->leftJoin($params['alias'].'.Translation '.$nalias.' WITH '.$nalias.'.lang = ?',sfContext::getInstance()->getUser()->getCulture());
    }

    protected function contains($crit, $query)
    {
        return (strpos($query->getDql(),$crit) !== false);
    }
}