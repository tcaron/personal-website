<?php

namespace Website\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)

    {
        
        return $this->render('WebsiteAdminBundle:Default:index.html.twig');
    }

    public function loginAction(Request $request){
      
     // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirectToRoute('website_admin_homepage');
    } 

    	$authentication = $this->get('security.authentication_utils');
    	//recupération des erreurs si il y en a une
    	$error = $authentication->getLastAuthenticationError();
    	//recupération du nom d'utilisateur
        $lastUsername = $authentication->getLastUsername();

        return $this->render('WebsiteAdminBundle:Security:login.html.twig', array(
        	'last_username' => $lastUsername,
             'error' => $error,
        	));

    }

}
