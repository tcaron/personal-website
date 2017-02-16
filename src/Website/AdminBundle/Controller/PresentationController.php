<?php 
namespace Website\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Website\AdminBundle\Entity\Presentation;
use Website\AdminBundle\Entity\PresentationTraduction;
use Website\AdminBundle\Form\PresentationType;

class PresentationController extends Controller{


	public function indexAction(Request $request){


	    $em = $this->getDoctrine()->getManager();
        $presentation = new Presentation();
        $presentation->addPresentationTraduction(new PresentationTraduction());
        $presentation->addPresentationTraduction(new PresentationTraduction());
        $form = $this->createForm(PresentationType::class,$presentation);
        $form->handleRequest($request);

        $exist_presentation = $em->getRepository("WebsiteAdminBundle:Presentation")->findAll();
        $exist_traduction = $em->getRepository("WebsiteAdminBundle:PresentationTraduction")->findAll();

        if ( $form->isSubmitted() && $form->isValid())
        {

              if (empty($exist_presentation) && empty($exist_traduction)){
              {
                $presentation2 = new Presentation();
                $em->persist($presentation2);
                $em->flush();
                $presentationTraduction = $form->get('presentationTraduction')->getData();

                foreach ($presentationTraduction as $traduction)
                {
                     $traduction->setPresentationId($presentation2);
                     $traduction->setDescription($traduction->getDescription());
                     $traduction->setLocale($traduction->getLocale());
                     $em->persist($traduction);                
                }

                $em->flush();

            }


        }



     } 

	   return $this->render('WebsiteAdminBundle:Default:presentation.html.twig',array(
	   'form'=>$form->createView(), 'traductions' => $exist_traduction ));
	
	}


}