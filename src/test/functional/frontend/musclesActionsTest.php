<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/muscles/index')->
  /*
  with('request')->begin()->
    isParameter('module', 'muscles')->
    isParameter('action', 'index')->
  end()->
  */
  with('response')->begin()->
    isStatusCode(401)->
    /*checkElement('body', '!/This is a temporary page/')->*/
  end()
;
