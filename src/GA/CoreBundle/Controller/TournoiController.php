<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GA\CoreBundle\Entity\Tournoi;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Entity\One;
use GA\CoreBundle\Form\TournoiType;
use GA\CoreBundle\Form\RondeType;


class TournoiController extends Controller
{
    public function viewAction($id)
    {
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em->getRepository('GACoreBundle:Tournoi')->find($id);

			if (null === $tournoi) {
      throw new NotFoundHttpException("Le tournoi d'id ".$id." n'existe pas.");
			}
			
			$listRonde = $em
				->getRepository('GACoreBundle:Ronde')
				->findBy(array('tournoi' => $tournoi))
    ;
			return $this->render('GACoreBundle:Tournoi:view.html.twig', array(
			'tournoi' => $tournoi,
			'listRonde' => $listRonde
			));
    }
		
		public function addAction(Request $request)
		{	
			/*
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
			
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($tournoi);
			$em->persist($ronde1);
			$em->persist($ronde2);
			$em->flush();
			
			return $this->redirectToRoute('ga_core_annonce', array('page' => 1));
			//return $this->render('GACoreBundle:Tournoi:add.html.twig');
			
			$tournoi = new tournoi();
			$form   = $this->get('form.factory')->create(TournoiType::class, $tournoi);

				if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($tournoi);
					$rondes = $tournoi->getRondes();
					
					foreach($rondes as $ronde){
				  
					$em->persist($ronde);
					
					}
					$em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Tournoi bien enregistrée.');

      return $this->redirectToRoute('ga_core_tounoi_id', array('id' => $tournoi->getId()));
			
			return $this->render('GACoreBundle:Tournoi:add.html.twig', array(
      'form' => $form->createView(),));
			
			*/
			 $tournoi = new Tournoi();
    $form   = $this->get('form.factory')->create(tournoiType::class, $tournoi);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($tournoi);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      return $this->redirectToRoute('ga_core_tournoi', array('id' => $tournoi->getId()));
    }

    return $this->render('GACoreBundle:Tournoi:add.html.twig', array(
      'form' => $form->createView(),
    ));
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
