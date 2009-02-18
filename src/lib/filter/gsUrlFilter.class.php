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
            $context->getLogger()->log('URL: '.$url);
        }
        else
            $context->getLogger()->log('SWITCHING LANGUAGE');

        $filterChain->execute();
    }
}