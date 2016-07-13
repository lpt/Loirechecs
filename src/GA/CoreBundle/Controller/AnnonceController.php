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
use GA\CoreBundle\Form\AnnonceType;
use GA\CoreBundle\Form\AnnonceEditType;

class AnnonceController extends Controller
{
    public function indexAction($page)
    {
			// On renvoie une exeption si la page n'existe pas
			if($page<1)
			{
				throw new notFoundHttpException('La page "'.$page.'" n\'existe pas.');
			}
			
			$nbPerPage = 3;
			
			// On récupère le repository
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Annonce');
				
			$listeAnnonce  = $repository->findAll();
			
			$nbPages = ceil(count($listeAnnonce) / $nbPerPage);
			// Si la page n'existe pas, on retourne une 404
			if ($page > $nbPages) {
      throw $this->createNotFoundException('La page "'.$page.'" n\'existe pas.');
			}
			
			// on récupère la liste des news
					
      return $this->render('GACoreBundle:Annonce:index.html.twig', array(
      'listeAnnonce'	=> $listeAnnonce,
			'nbPages'				=> $nbPages,
			'page'					=> $page,
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
			
			$form = $this->get('form.factory')->create(AnnonceType::class, $annonce)
				
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
		
		public function editAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			
			$annonce = $em->getRepository('GACoreBundle:Annonce')->find($id);
			
			if ($annonce === null){
				throw new NotFoundHttpException('L\'annonce '.$id.'n\'existe pas.');
			}
			
			$form = $this->get('form.factory')->create(AnnonceEditType::class, $annonce);
			
			if ($request->isMethod('POST')){
				
				$form->handleRequest($request);
				
				if($form->isValid()){
					
					$em = $this->getDoctrine()->getManager();
					$annonce->setDateModif(New \DateTime);
					$em->persist($annonce);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Annonce modifié');
					
					return $this->redirectToRoute('ga_core_annonce_id', array('id' => $annonce->getId()));
				}
			}
			
			return $this->render('GACoreBundle:Annonce:edit.html.twig', array(
			'form' => $form->createView(),));
		}
		
		public function deleteAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$annonce = $em->getRepository('GACoreBundle:Annonce')->find($id);
			
			if (null === $annonce) {
				throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
			}
			// On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em->remove($annonce);
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
				
				return $this->redirectToRoute('ga_core_annonce', array('page' => 1));
			}
    
			return $this->render('GACoreBundle:Annonce:delete.html.twig', array(
      'annonce' => $annonce,
      'form'   => $form->createView(),
			));
			
		}
		
		public function admin()
		{
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Annonce');
				
			$listeAnnonce  = $repository->findAll();
				
			return $this->render('GACoreBundle:Annonce:admin.html.twig', array(
			'listeAnnonce' => $listeAnnonce
			));
	}
}
