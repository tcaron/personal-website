<?php 
namespace Website\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilder;
use Website\AdminBundle\Entity\Presentation;
use Website\AdminBundle\Form\PresentationType;
class PresentationController extends Controller{

	public function indexAction(Request $request){
		
		$presentation = new Presentation();
		// Construction du formulaire
		$formBuilder = $this->get('form.factory')->createBuilder(PresentationType::class,$presentation);
		$form = $formBuilder->getForm();

        // Verification et enregistrement des données
        $form->handleRequest($request);

		if ($form->isValid() && $form->isSubmitted())
	    	$presentation = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->persist($presentation);
			$presentation->mergeNewTranslations();
			$em->flush($presentation);

		return $this->render('WebsiteAdminBundle:Default:presentation.html.twig',array('form'=>$form->createView()));
	}


}