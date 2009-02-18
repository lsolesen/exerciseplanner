<?php

class gsUrlFilter extends sfFilter
{
    public function execute($filterChain)
    {
        $context = sfContext::getInstance();

        if($context->getModuleName() != 'sfGuardAuth' && $context->getActionName() != 'switchLanguage')
        {
            $routing = $context->getRouting();
            $url = $routing->getCurrentInternalUri();
            $context->getUser()->setAttribute('url',$url,'language');
        }

        $filterChain->execute();
    }
}