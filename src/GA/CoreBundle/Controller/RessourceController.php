<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GA\CoreBundle\Entity\Ressource;
use GA\CoreBundle\Entity\Lien;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Form\RessourceAddLienType;
use GA\CoreBundle\Form\RessourceDeleteLienType;
use GA\CoreBundle\Form\DeleteType;



class RessourceController extends Controller
{
   	public function addAnnonceAction($id, $type, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addTournoiAction($id, $type, Request $request)
		{
			return $this->redirectToRoute('ga_core_admin');
		}
		
		public function addRondeAction($id, $num, $type, Request $request)
		{
			switch($type)
			{
				case 1:	
					//return $this->forward('ga_core.lien_controller:addRondeAction', array('request' => $request, 'id' => $id, 'num' => $num));
					return $this->addRondeLien($id, $num, $request);
					break;
				default:
					throw new NotFoundHttpException("le type ".$type." n'existe pas.");
			}
			
		}
		
		public function editRondeAction($id, $num, $type, $idR, Request $request)
		{
			switch($type)
			{
				case 1:	
					return $this-> editlien($idR, $request);
					break;
				default:
					throw new NotFoundHttpException("le type ".$type." n'existe pas.");
			}
			
			
		}
		
		public function deleteRondeAction($id, $num, $type, $idR, Request $request)
		{
			switch($type)
			{
				case 1:	
					return $this-> deletelien($idR, $request);
					break;
				default:
					throw new NotFoundHttpException("le type ".$type." n'existe pas.");
			}
			
			
		}
		
		public function addRondeLien($id, $num, $request)
		{
			$ressource = new Ressource;
			$lien = new Lien;
						
			$form   = $this->container->get('form.factory')->create(ressourceAddLienType::class, $ressource);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$ressource->setLien($lien); 
					$ressource->setType(1);
					$ressource->setDateCreate(New \DateTime);
					$ressource->setDateModif(New \DateTime);
					
					$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
										
					$listeRonde = $tournoi->getRondes();
					
					$numero = $num - 1;
					$ronde = $listeRonde[$numero];
					
					$ronde->addRessource($ressource);
								
					$em->persist($ressource);
					$em->persist($ronde);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Ressource bien enregistrée.');

					return $this->redirectToRoute('ga_core_tournoi', array('id' => $id));
					
			}
			
			return $this->render('GACoreBundle:Ressource:addLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		public function editLien($idR, $request)
		{	
			$em = $this->getDoctrine()->getManager();
					$ressource = $em
						->getRepository('GACoreBundle:Ressource')
						->find($idR);
						
			$form   = $this->container->get('form.factory')->create(ressourceAddLienType::class, $ressource);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$ressource->setDateModif(New \DateTime);
					$em->persist($ressource);
					$em->flush();
					
					if ($ressource === null)
					{
						throw new NotFoundHttpException("la ressource ".$idr."n\'existe pas.");
					}
					
					$request->getSession()->getFlashBag()->add('notice', 'Ressource bien enregistrée.');

					return $this->redirectToRoute('ga_core_admin');
					
			}
			
			return $this->render('GACoreBundle:Ressource:editLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		public function deleteLien($idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$ressource = $em
					->getRepository('GACoreBundle:Ressource')
					->find($idR);
					
			if ($ressource === null){
				throw new NotFoundHttpException("la ressource ".$idR."n'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create(DeleteType::class, $ressource);
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em->remove($ressource);						
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "La ressource a bien été supprimée.");
				
				return $this->redirectToRoute('ga_core_admin');
			}
			
			return $this->render('GACoreBundle:Ressource:deleteLien.html.twig', array(
      'ressource' => $ressource,
      'form'   => $form->createView(),
			));
			
		}
		
}
