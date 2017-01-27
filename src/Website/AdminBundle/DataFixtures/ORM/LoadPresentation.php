<?php
// src/OC/UserBundle/DataFixtures/ORM/LoadUser.php

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Website\AdminBundle\Entity\Presentation;

class LoadPresentation implements FixtureInterface{
	
  public function load(ObjectManager $manager)
  {
    $pres = new Presentation();
    $pres->translate('fr')->setName('Ceci est un test');
    $pres->translate('fr')->setDescription('ce texte est un test');
    $pres->translate('en')->setName('This is a test');
    $pres->translate('en')->setDescription('This text is a test');
    
    $manager->persist($pres);
    $pres->mergeNewTranslations();
    $manager->flush($pres);
  }
	
} 