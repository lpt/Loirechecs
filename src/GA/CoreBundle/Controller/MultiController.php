<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MultiController extends Controller
{
    public function viewAction($id)
    {
			return $this->render('GACoreBundle:Multi:view.html.twig', array('id' => $id));
    }
		
		public function addAction()
		{
			//On ajoute un tournoi multi journées
			return $this->render('GACoreBundle:Multi:add.html.twig');
			
		}
		
		public function editAction($id)
		{
			//On modifie un tournoi multi journées
			return $this->render('GACoreBundle:Multi:edit.html.twig', array('id' => $id));
		}
		
		public function deleteAction($id)
		{
			//On supprime un tournoi multi journées
			return $this->render('GACoreBundle:Multi:delete.html.twig', array('id' => $id));
		}
}
