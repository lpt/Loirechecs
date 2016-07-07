<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GA\CoreBundle\Entity\Tournoi;
use GA\CoreBundle\Entity\Ronde;

class TournoiController extends Controller
{
    public function viewAction($id)
    {
			return $this->render('GACoreBundle:Tournoi:view.html.twig', array('id' => $id));
    }
		
		public function addAction()
		{	
			$tournoi = new Tournoi();
			$tournoi->setNom('Tournoi Test1');
			$tournoi->setDescription('Description du tournoi Test1');
			$tournoi->setContactNom('GA');
			$tournoi->setContactTph('06-45-27-54-39');
			$tournoi->setContactMail('gandre@etn.fr');
			
			$ronde1 = new Ronde();
			$ronde1->setNumero(1);
			$ronde1->setDateEvent(New \DateTime);
			$ronde1->setAdresse('36 Rue Des Vercheres');
			$ronde1->setVille('GENILAC');
			
			$ronde2 = new Ronde();
			$ronde2->setNumero(2);
			$ronde2->setDateEvent(New \DateTime);
			$ronde2->setAdresse('36 Rue Des Vercheres');
			$ronde2->setVille('GENILAC');
			
			$tournoi->addRonde($ronde1);
			$tournoi->addRonde($ronde2);
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($tournoi);
			//$em->persist($ronde1);
			//$em->persist($ronde2);
			$em->flush();
			
			return $this->redirectToRoute('ga_core_annonce', array('page' => 1));
			//return $this->render('GACoreBundle:Tournoi:add.html.twig');
			
		}
		
		public function editAction($id)
		{
			
			return $this->render('GACoreBundle:Tournoi:edit.html.twig', array('id' => $id));
		}
		
		public function deleteAction($id)
		{
			
			return $this->render('GACoreBundle:Tournoi:delete.html.twig', array('id' => $id));
		}
}
