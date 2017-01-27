<?php

namespace Website\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebsiteMainBundle:Default:index.html.twig');
    }
}
