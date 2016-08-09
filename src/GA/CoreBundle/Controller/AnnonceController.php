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
use GA\CoreBundle\Form\AnnonceAddType;
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
		
		public function viewAction(Annonce $annonce, $id)
		{
			return $this->render('GACoreBundle:Annonce:view.html.twig', array(
      'annonce' => $annonce
			));
		}
		
		public function addAction(Request $request)
		{
			
			$annonce = new Annonce();
			
			// test  d affectation d'un tournoi
			
			$tournoiId = $request->query->get('tournoi_id');
			
			
			$em = $this->getDoctrine()->getManager();
			
			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($tournoiId);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			$annonce->setTitre($tournoi->getNom());
			
			// fin de test
			
			$form = $this->get('form.factory')->create(AnnonceAddType::class, $annonce);
			
			
			
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
			'form' => $form->createView(),
			));
			
		}
		
		public function editAction(Annonce $annonce, $id, Request $request)
		{
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
		
		public function deleteAction(Annonce $annonce, $id, Request $request)
		{
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
		
		public function adminAction()
		{
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Annonce');
				
			$listeAnnonce  = $repository->findAll();
			
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Tournoi');
					
			$tournoi = $repository->find(1);
				
			return $this->render('GACoreBundle:Annonce:admin.html.twig', array(
			'listeAnnonce' => $listeAnnonce,
			'tournoi' => $tournoi,
			));
		}
		
		public function adminViewAction(Annonce $annonce, $id)
		{
			return $this->render('GACoreBundle:Annonce:adminView.html.twig', array(
				'annonce' => $annonce
				));

		}
	
	// GESTION DES RESSOURCES D UNE ANNONCE
			// AJOUTS
		
		public function addRondeLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addRondeImageAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addRondeResultatAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addRondeAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
			// EDITIONS
				
		public function editRondeLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
					
			// SUPPRESSIONS
			
		public function deleteRondeLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function deleteRondeImageAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function deleteRondeResultatAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function deleteRondeAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
}
