<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
	public function indexAction()
	{
		return $this->render('GACoreBundle:Admin:index.html.twig');
	}
	
	public function annonceIndexAction()
	{
		$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Annonce');
				
		$listeAnnonce  = $repository->findAll();
				
		return $this->render('GACoreBundle:Admin:indexAnnonce.html.twig', array(
			'listeAnnonce' => $listeAnnonce
		));
	}
	
	public function tournoiIndexAction()
	{
		$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Tournoi');
				
		$listeTournoi  = $repository->findAll();
		
		return $this->render('GACoreBundle:Admin:indexTournoi.html.twig', array(
			'listeTournoi' => $listeTournoi
		));
	}
	
	public function agendaIndexAction()
	{
		return $this->render('GACoreBundle:Admin:indexAngenda.html.twig');
	}
	
	
}