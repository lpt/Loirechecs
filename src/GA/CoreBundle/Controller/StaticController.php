<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
    public function adminAction()
    {
				return $this->render('GACoreBundle:Static:admin.html.twig');
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
		
		public function indexAction()
	{
		return $this->render('GACoreBundle:Admin:index.html.twig');
	}
	
				
}
