<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
    public function adminAction()
    {
				$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Annonce');
				
				$listeAnnonce  = $repository->findAll();
				
				return $this->render('GACoreBundle:Static:admin.html.twig',	array(
				'listeAnnonce' => $listeAnnonce
				));
    }
		
		public function presentationAction()
    {
        return $this->render('GACoreBundle:Static:presentation.html.twig');
    }
		
		public function organigrammeAction()
    {
        return $this->render('GACoreBundle:Static:organigramme.html.twig');
    }
		
		public function clubsAction()
    {
        return $this->render('GACoreBundle:Static:clubs.html.twig');
    }
		
		public function tarifAction()
    {
        return $this->render('GACoreBundle:Static:tarif.html.twig');
    }
		
		
}
