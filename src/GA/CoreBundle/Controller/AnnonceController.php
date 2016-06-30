<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnnonceController extends Controller
{
    public function indexAction($page)
    {
			// On renvoie une exeption si la page n'existe pas
			if($page<1)
			{
				throw new notFoundHttpException('page "'.$page.'" inexistante');
			}
			// on affichera X news par pages 
			
			// on calcul le nombre de page 
			
			// on affichera la page $page avec $nbrPages
			
					
      return $this->render('GACoreBundle:Annonce:index.html.twig');
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
		
		public function addAction($type)
		{
			//On ajoute une annonce en fonction du type => mono, multi ou divers
			return $this->render('GACoreBundle:Annonce:add.html.twig');
			
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
