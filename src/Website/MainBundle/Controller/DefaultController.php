<?php

namespace Website\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$presentation = $em->getRepository("WebsiteAdminBundle:Presentation")->getPresentation($request->getLocale());
        return $this->render('WebsiteMainBundle:Default:index.html.twig',array('presentation' => $presentation ));
    }
}
