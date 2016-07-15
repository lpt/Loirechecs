<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GA\CoreBundle\Entity\Ressource;
use GA\CoreBundle\Entity\Lien;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Form\RessourceAddLienType;


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
					$serviceLien = $this->container->get('ga_core.lien');
					return $serviceLien-> addRondelien($id, $num,  $request);
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
					return $this-> editRondelien($idR, $request);
					break;
				default:
					throw new NotFoundHttpException("le type ".$type." n'existe pas.");
			}
			
		}
		
		
		
}
