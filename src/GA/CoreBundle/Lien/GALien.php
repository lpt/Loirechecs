<?php

namespace GA\CoreBundle\Lien;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GA\CoreBundle\Entity\Ressource;
use GA\CoreBundle\Entity\Lien;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Form\RessourceAddLienType;

class GALien extends Controller
{
   			
		public function addRondeLien($id, $num, $request)
		{
			$ressource = new Ressource;
			$lien = new Lien;
						
			$form   = $this->get('form.factory')->create(ressourceAddLienType::class, $ressource);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$ressource->setLien($lien); 
					$ressource->setType($type);
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

		
}
