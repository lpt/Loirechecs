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
use GA\CoreBundle\Entity\Lien;
use GA\CoreBundle\Entity\Resultat;
use GA\CoreBundle\Entity\Affiche;
use GA\CoreBundle\Entity\Image;
use GA\CoreBundle\Form\LienAddType;
use GA\CoreBundle\Form\ResultatAddType;
use GA\CoreBundle\Form\TournoiType;
use GA\CoreBundle\Form\DeleteType;
use GA\CoreBundle\Form\AfficheAddType;
use GA\CoreBundle\Form\ImageAddType;

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
				
			$listeAnnonce  = $repository->findListeAnnoncePost();
			
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
				
			$listeAnnonce  = $repository->findAllInv();
			
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
		
		public function addLienAction($id, Request $request)
		{
			$lien = new Lien;
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$lien->setDateCreate(New \DateTime);
					$lien->setDateModif(New \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 			
									
					$annonce = $em
					->getRepository('GACoreBundle:Annonce')
					->find($id);			
							
					$annonce->addLien($lien);
								
					$em->persist($lien);
					$em->persist($annonce);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_annonce_id_admin', array('id' => $id));
			}
			
			return $this->render('GACoreBundle:Annonce:addLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		public function addImageAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addResultatAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
			// EDITIONS
				
		public function editLienAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
						->getRepository('GACoreBundle:Lien')
						->find($idR);
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$lien->setDateModif(New  \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 
					$em->persist($lien);
					$em->flush();
					
					if ($lien === null)
					{
						throw new NotFoundHttpException("Le lien ".$idr."n\'existe pas.");
					}
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_admin');
					
			}
			
			return $this->render('GACoreBundle:Annonce:editLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
					
			// SUPPRESSIONS
			
		public function deleteLienAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
					->getRepository('GACoreBundle:Lien')
					->find($idR);
					
			if ($lien === null)
			{
				throw new NotFoundHttpException("le lien ".$idR."n'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create(DeleteType::class, $lien);
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
			{
				$em->remove($lien);						
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "Le lien a bien été supprimée.");
				
				return $this->redirectToRoute('ga_core_admin');
			}
			
			return $this->render('GACoreBundle:Annonce:deleteLien.html.twig', array(
      'lien' => $lien,
      'form'   => $form->createView(),
			));
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
