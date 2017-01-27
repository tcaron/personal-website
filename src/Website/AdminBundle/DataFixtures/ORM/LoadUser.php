<?php
// src/OC/UserBundle/DataFixtures/ORM/LoadUser.php

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Website\AdminBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $name = 'thomas';
    // On crée l'utilisateur
    $user = new User;
    // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
    $user->setUsername($name);
    $user->setPassword($name);
    // On ne se sert pas du sel pour l'instant
    $user->setSalt('');
    // On définit uniquement le role ROLE_USER qui est le role de base
    $user->setRoles(array('ROLE_ADMIN'));
    // On le persiste
    $manager->persist($user);
    // On déclenche l'enregistrement
    $manager->flush();
  }
}