<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GA\CoreBundle\Entity\Tournoi;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Form\TournoiType;


class TournoiController extends Controller
{
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
}
