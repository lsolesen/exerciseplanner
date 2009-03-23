<?php

require_once dirname(__FILE__).'/../lib/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        // for compatibility / remove and enable only the plugins you want
        $this->enablePlugins(array('sfDoctrinePlugin', 'sfDoctrineGuardPlugin','sfProtoculousPlugin', 'symfonyUnderControlPlugin','sfDoctrineActAsTaggablePlugin'));
    }

    public function configureDoctrine(Doctrine_Manager $manager)
    {
        $manager->setAttribute('use_dql_callbacks', true);
    }
}
