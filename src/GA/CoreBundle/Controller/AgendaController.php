<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgendaController extends Controller
{
    public function indexAction()
    {
       return $this->render('GACoreBundle:Agenda:index.html.twig');
    }
		
		public function addAction()
		{
			return $this->render('GACoreBundle:Agenda:add.html.twig');
		}
		
		public function editAction()
		{
			return $this->render('GACoreBundle:Agenda:edit.html.twig');
		}
		
		public function deleteAction()
		{
			return $this->render('GACoreBundle:Agenda:delete.html.twig');
		}
}
