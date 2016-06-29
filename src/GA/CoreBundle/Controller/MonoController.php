<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MonoController extends Controller
{
 		public function viewAction($id)
		{
			//on récupère les élements du tournoi mono journée id=$id
			return $this->render('GACoreBundle:mono:view.html.twig', array('id' => $id));
		}
		
		public function addAction()
		{
			//On ajoute un tournoi monojournée
			return $this->render('GACoreBundle:mono:add.html.twig');
		}
		
		public function editAction($id)
		{
			//On modifie un tournoi mono journée
			return $this->render('GACoreBundle:mono:edit.html.twig', array('id' => $id));
		}
		
		public function deleteAction($id)
		{
			//On supprime un tournoi mono journée
			return $this->render('GACoreBundle:mono:delete.html.twig', array('id' => $id));
		}
}
