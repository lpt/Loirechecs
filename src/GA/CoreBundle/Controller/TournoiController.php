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
			return $this->render('GACoreBundle:Tournoi:view.html.twig', array('id' => $id));
    }
		
		public function addAction(Request $request)
		{	
			$tournoi = new Tournoi();
			$form = $this->get('form.factory')->create(TournoiType::class, $tournoi);
			
			if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($tournoi);
				$em->flush();
				
				$request->getSession()->getFlashbag()->add('notice', 'Tournoi bien enregistré.');
				
				return $this->redirectToRoute('ga_core_tournoi', array('id' => $tournoi->getId()));
			}
			
			return $this->render('GACoreBundle:Tournoi:add.html.twig',array(
				'form' => $form->createView(),
			));
			
		}
		
		public function editAction($id)
		{
			
			return $this->render('GACoreBundle:Tournoi:edit.html.twig', array('id' => $id));
		}
		
		public function deleteAction($id)
		{
			
			return $this->render('GACoreBundle:Tournoi:delete.html.twig', array('id' => $id));
		}
}
