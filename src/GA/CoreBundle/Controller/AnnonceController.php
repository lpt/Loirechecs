<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use GA\CoreBundle\Entity\Annonce;

class AnnonceController extends Controller
{
    public function indexAction($page)
    {
			// On renvoie une exeption si la page n'existe pas
			if($page<1)
			{
				throw new notFoundHttpException('page "'.$page.'" inexistante');
			}
			// On récupère le repository
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Annonce');
				
			$listeAnnonce  = $repository->findAll();
			
			// on récupère la liste des news
					
      return $this->render('GACoreBundle:Annonce:index.html.twig', array(
      'listeAnnonce' => $listeAnnonce
			));
    }
		
		public function viewAction($id)
		{
			// On récupère le repository
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Annonce');

			// On récupère l'entité correspondante à l'id $id
			$annonce = $repository->find($id);

			// On verifie que l'Entity n'est pas null
			if (null === $annonce) {
				throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
			}
		
			// On envoie les données à la vue
			
			return $this->render('GACoreBundle:Annonce:view.html.twig', array(
      'annonce' => $annonce
			));
	
		}
		
		public function addAction(Request $request)
		{
			$annonce = new Annonce();

			$form = $this->get('form.factory')->createBuilder(FormType::class, $annonce)
				->add('titre',     TextType::class)
				->add('auteur',   TextType::class)
				->add('contenu',    TextareaType::class)
				->add('save',      SubmitType::class)
				->getForm()
			;
			
			if ($request->isMethod('POST')){
				
				$form->handleRequest($request);
				
				if($form->isValid()){
					
					$em = $this->getDoctrine()->getManager();
					$em->persist($annonce);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Annonce enregistrée');
					
					return $this->redirectToRoute('ga_core_annonce_id', array('id' => $annonce->getId()));
				}
			}
			
			return $this->render('GACoreBundle:Annonce:add.html.twig', array(
			'form' => $form->createView(),));
			
		}
		
		public function editAction($id)
		{
			//On modifie une annonce en fonction du type => mono, multi ou divers
			return $this->render('GACoreBundle:Annonce:edit.html.twig');
		}
		
		public function deleteAction($id)
		{
			//On supprime une annonce en fonction du type => mono, multi ou divers
			return $this->render('GACoreBundle:Annonce:delete.html.twig');
		}
}
