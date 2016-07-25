<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use GA\CoreBundle\Entity\Tournoi;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Form\TournoiType;


class TournoiController extends Controller
{		
		//GESTION DU TOURNOI
		
    public function viewAction($id)
    {
			$em = $this->getDoctrine()->getManager();

			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			return $this->render('GACoreBundle:Tournoi:view.html.twig', array(
				'id' => $id,
				'tournoi' => $tournoi
				));

    }
		
		public function addAction(Request $request)
		{	
			$tournoi = new Tournoi();
			$form   = $this->get('form.factory')->create(tournoiType::class, $tournoi);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($tournoi);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

				return $this->redirectToRoute('ga_core_tournoi', array('id' => $tournoi->getId()));
			}

			return $this->render('GACoreBundle:Tournoi:add.html.twig', array(
				'form' => $form->createView(),
    ));
    }
		
		public function editAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			$form = $this->get('form.factory')->create(TournoiType::class, $tournoi);
			
			if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($tournoi);
				$em->flush();
				
				$request->getSession()->getFlashbag()->add('notice', 'Tournoi bien enregistré.');
				
				return $this->redirectToRoute('ga_core_tournoi', array('id' => $tournoi->getId()));
			}
			
			return $this->render('GACoreBundle:Tournoi:edit.html.twig', array(
			'form' => $form->createView(),
			'id' => $id,
			'tournoi' => $tournoi
			));
		}
		
		public function deleteAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($tournoi);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
				
			return $this->redirectToRoute('ga_core_annonce', array('page' => 1));
			}
			
			return $this->render('GACoreBundle:Tournoi:delete.html.twig', array(
      'tournoi' => $tournoi,
      'form'   => $form->createView(),
			));
			
		}
			
		public function adminAction()
		{
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Tournoi');
				
			$listeTournoi  = $repository->findAll();
		
			return $this->render('GACoreBundle:Tournoi:admin.html.twig', array(
				'listeTournoi' => $listeTournoi
			));
		}
		
		public function adminViewAction($id)
    {
			$em = $this->getDoctrine()->getManager();

			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			return $this->render('GACoreBundle:Tournoi:adminView.html.twig', array(
				'id' => $id,
				'tournoi' => $tournoi
				));

    }
		
		// GESTION DES RESSOURCES DU TOURNOI
		
			//AJOUTS
		
		public function addTournoiLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
	
		public function addTournoiAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
			
			//EDITIONS
			
		public function editTournoiLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function editTournoiAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
			
			// SUPPRESSIONS
			
		public function deleteTournoiLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function deleteTournoiAfficheAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		// GESTION DES RESSOURCES D UNE RONDE
		
			// AJOUTS
		
		public function addRondeLienAction($id, $num,  Request $request)
		{
			
			$lien = new Lien;
						
			$form   = $this->container->get('form.factory')->create(AddLienType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$lien->setDateCreate(New \DateTime);
					$lien>setDateModif(New \DateTime);
					
					$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
										
					$listeRonde = $tournoi->getRondes();
					
					$numero = $num - 1;
					$ronde = $listeRonde[$numero];
					
					$ronde->addLien($lien);
								
					$em->persist($lien);
					$em->persist($ronde);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_tournoi', array('id' => $id));
					
			}
			
			return $this->render('GACoreBundle:Ressource:addLien.html.twig', array(
				'form' => $form->createView(),
			));
		
		}
		
		public function addRondeImageAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addRondeResultatAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
				
			// EDITIONS
				
		public function editRondeLienAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function editRondeImageAction($id, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function editRondeResultatAction($id, Request $request)
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
		
}
