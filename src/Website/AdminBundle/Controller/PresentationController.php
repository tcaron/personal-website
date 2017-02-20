<?php 
namespace Website\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Website\AdminBundle\Entity\Presentation;
use Website\AdminBundle\Entity\PresentationTraduction;
use Website\AdminBundle\Form\PresentationType;

class PresentationController extends Controller{


	public function indexAction(){
       
       $em = $this->getDoctrine()->getManager();
       $presentations = $em->getRepository("WebsiteAdminBundle:Presentation")->findAll();

	   return $this->render('WebsiteAdminBundle:Presentation:presentation.html.twig', array(
        'presentations' => $presentations
        ));
	
	}


    public function createAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $presentation = new Presentation();
        $locales = $this->getParameter('locales');

        foreach ($locales as $locale)
            $presentation->addPresentationTraduction(new PresentationTraduction());

        $form = $this->createForm(PresentationType::class,$presentation);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) 
        {
            $new_presentation = new Presentation();
            $em->persist($new_presentation);
            $em->flush();
            $presentationTraduction = $form->get('presentationTraduction')->getData();

            foreach ($presentationTraduction as $traduction)
            {
                $traduction->setPresentationId($new_presentation);
                $traduction->setDescription($traduction->getDescription());
                $traduction->setLocale($traduction->getLocale());
                $em->persist($traduction);                
                $em->flush(); 
            }

            return $this->redirectToRoute('website_admin_presentation');
        }

    return $this->render('WebsiteAdminBundle:Presentation:create_form.html.twig',array(
        "form" => $form->createView(),
        ));

    }

    public function editAction(Request $request, $id){
    
       $em = $this->getDoctrine()->getManager();
       $presentation = $em->getRepository("WebsiteAdminBundle:Presentation")->find($id);
       $form = $this->createForm(PresentationType::class,$presentation);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid())
       {
            $presentationTraduction = $form->get('presentationTraduction')->getData();

            foreach ($presentationTraduction as $traduction)
            {
                $traduction->setDescription($traduction->getDescription());
                $traduction->setLocale($traduction->getLocale());
                $em->persist($traduction);                
                $em->flush(); 
            }

            return $this->redirectToRoute('website_admin_presentation');
       }

       return $this->render('WebsiteAdminBundle:Presentation:edit_form.html.twig',array(
       'form' => $form->createView()
       ));
    }


}