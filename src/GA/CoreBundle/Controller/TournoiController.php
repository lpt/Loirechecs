<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GA\CoreBundle\Entity\Tournoi;
use GA\CoreBundle\Entity\Ronde;
use GA\CoreBundle\Entity\Lien;
use GA\CoreBundle\Entity\Resultat;
use GA\CoreBundle\Entity\Affiche;
use GA\CoreBundle\Entity\Image;
use GA\CoreBundle\Form\LienAddType;
use GA\CoreBundle\Form\ResultatAddType;
use GA\CoreBundle\Form\TournoiType;
use GA\CoreBundle\Form\DeleteType;
use GA\CoreBundle\Form\AfficheAddType;
use GA\CoreBundle\Form\ImageAddType;


class TournoiController extends Controller
{		
		//GESTION DU TOURNOI
		
    public function viewAction($id)
    {
			$em = $this->getDoctrine()->getManager();

			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			return $this->render('GACoreBundle:Tournoi:view.html.twig', array(
				'id' => $id,
				'tournoi' => $tournoi
				));

    }
		
		public function addAction(Request $request)
		{	
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
		
		public function editAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			$form = $this->get('form.factory')->create(TournoiType::class, $tournoi);
			
			if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($tournoi);
				$em->flush();
				
				$request->getSession()->getFlashbag()->add('notice', 'Tournoi bien enregistré.');
				
				return $this->redirectToRoute('ga_core_tournoi', array('id' => $tournoi->getId()));
			}
			
			return $this->render('GACoreBundle:Tournoi:edit.html.twig', array(
			'form' => $form->createView(),
			'id' => $id,
			'tournoi' => $tournoi
			));
		}
		
		public function deleteAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($tournoi);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
				
			return $this->redirectToRoute('ga_core_annonce', array('page' => 1));
			}
			
			return $this->render('GACoreBundle:Tournoi:delete.html.twig', array(
      'tournoi' => $tournoi,
      'form'   => $form->createView(),
			));
			
		}
			
		public function adminAction()
		{
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Tournoi');
				
			$listeTournoi  = $repository->findAll();
			
			return $this->render('GACoreBundle:Tournoi:admin.html.twig', array(
				'listeTournoi' => $listeTournoi,
				));
		}
		
		public function adminViewAction($id)
    {
			$em = $this->getDoctrine()->getManager();

			$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
					
			if ($tournoi === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
			
			return $this->render('GACoreBundle:Tournoi:adminView.html.twig', array(
				'id' => $id,
				'tournoi' => $tournoi
				));

    }
		
		// GESTION DES RESSOURCES DU TOURNOI
		
			//AJOUTS
		
		public function addTournoiLienAction($id, Request $request)
		{
			$lien = new Lien;
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$lien->setDateCreate(New \DateTime);
					$lien->setDateModif(New \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 			
									
					$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);			
							
					$tournoi->addLien($lien);
								
					$em->persist($lien);
					$em->persist($tournoi);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
					
			}
			
			return $this->render('GACoreBundle:Tournoi:addLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
	
		public function addTournoiAfficheAction($id, Request $request)
		{
				$affiche = new Affiche();
        $form = $this->createForm(AfficheAddType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$affiche->setDateCreate(New \DateTime);
						$affiche->setDateModif(New \DateTime);
						$validator = $this->get('validator');
						$listErrors = $validator->validate($affiche);
						if(count($listErrors) > 0) 
						{
							return new Response((string) $listErrors);
						} 
						
						$tournoi = $em
						->getRepository('GACoreBundle:Tournoi')
						->find($id);
						
									
						$tournoi->addAffiche($affiche);
						
						$em->persist($affiche);
						$em->flush();

            return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
				}
				
				return $this->render('GACoreBundle:Tournoi:addAffiche.html.twig', array(
            'form' => $form->createView(),
        ));
		}
		
		public function addTournoiResultatAction($id, Request $request)
		{
				$resultat = new Resultat();
        $form = $this->createForm(ResultatAddType::class, $resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$resultat->setDateCreate(New \DateTime);
						$resultat->setDateModif(New \DateTime);
						$validator = $this->get('validator');
						$listErrors = $validator->validate($resultat);
						if(count($listErrors) > 0) 
						{
							return new Response((string) $listErrors);
						} 
						
						$tournoi = $em
						->getRepository('GACoreBundle:Tournoi')
						->find($id);
						
									
						$tournoi->addResultat($resultat);
						
						$em->persist($resultat);
						$em->flush();

            return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
        }

        return $this->render('GACoreBundle:Tournoi:addResultat.html.twig', array(
            'form' => $form->createView(),
        ));
		}
		
		public function addTournoiImageAction($id, Request $request)
		{
				$image = new Image();
        $form = $this->createForm(ImageAddType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$image->setDateCreate(New \DateTime);
						$image->setDateModif(New \DateTime);
						$validator = $this->get('validator');
						$listErrors = $validator->validate($image);
						if(count($listErrors) > 0) 
						{
							return new Response((string) $listErrors);
						} 
						
						$tournoi = $em
						->getRepository('GACoreBundle:Tournoi')
						->find($id);
						
									
						$tournoi->addImage($image);
						
						$em->persist($image);
						$em->flush();

            return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
				}
				
				return $this->render('GACoreBundle:Tournoi:addImage.html.twig', array(
            'form' => $form->createView(),
        ));
		}
			
			//EDITIONS
			
		public function editTournoiLienAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
						->getRepository('GACoreBundle:Lien')
						->find($idR);
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$lien->setDateModif(New  \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 
					$em->persist($lien);
					$em->flush();
					
					if ($lien === null)
					{
						throw new NotFoundHttpException("Le lien ".$idr."n\'existe pas.");
					}
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_admin');
					
			}
			
			return $this->render('GACoreBundle:Tournoi:editLien.html.twig', array(
				'form' => $form->createView(),
			));
			
		}
		
			// SUPPRESSIONS
			
		public function deleteTournoiLienAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
					->getRepository('GACoreBundle:Lien')
					->find($idR);
					
			if ($lien === null)
			{
				throw new NotFoundHttpException("le lien ".$idR."n'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create(DeleteType::class, $lien);
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
			{
				$em->remove($lien);						
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "Le lien a bien été supprimée.");
				
				return $this->redirectToRoute('ga_core_admin');
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteLien.html.twig', array(
      'lien' => $lien,
      'form'   => $form->createView(),
			));
		}
		
		public function deleteTournoiAfficheAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$affiche = $em
					->getRepository('GACoreBundle:Affiche')
					->find($idR);
								
			if ($affiche === null){
				throw new NotFoundHttpException("l\'affiche d'id".$idR."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($affiche);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L\'affiche a bien été supprimé.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteAffiche.html.twig', array(
      'affiche' => $affiche,
			'id' => $id,
		  'form'   => $form->createView(),
			));
		}
		
		public function deleteTournoiResultatAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$resultat = $em
					->getRepository('GACoreBundle:Resultat')
					->find($idR);
								
			if ($resultat === null){
				throw new NotFoundHttpException("le resultat d'id".$idR."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($resultat);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Le resultat a bien été supprimé.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteResultat.html.twig', array(
      'resultat' => $resultat,
			'id' => $id,
		  'form'   => $form->createView(),
			));
		}
			
		public function deleteTournoiImageAction($id, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$image = $em
					->getRepository('GACoreBundle:Image')
					->find($idR);
								
			if ($image === null){
				throw new NotFoundHttpException("l\'image d'id".$idR."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($image);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L\'image a bien été supprimé.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteImage.html.twig', array(
      'image' => $image,
			'id' => $id,
		  'form'   => $form->createView(),
			));
		}
		
		// GESTION DES RESSOURCES D UNE RONDE
		
			// AJOUTS
		
		public function addRondeLienAction($id, $num,  Request $request)
		{
			
			$lien = new Lien;
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$em = $this->getDoctrine()->getManager();
					$lien->setDateCreate(New \DateTime);
					$lien->setDateModif(New \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 
					
					$tournoi = $em
					->getRepository('GACoreBundle:Tournoi')
					->find($id);
										
					$listeRonde = $tournoi->getRondes();
					
					$numero = $num - 1;
					$ronde = $listeRonde[$numero];
					
					$ronde->addLien($lien);
								
					$em->persist($lien);
					$em->persist($ronde);
					$em->flush();
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
					
			}
			
			return $this->render('GACoreBundle:Tournoi:addLien.html.twig', array(
				'form' => $form->createView(),
			));
		
		}
		
		public function addRondeImageAction($id, $num, Request $request)
		{
				$image = new Image();
        $form = $this->createForm(ImageAddType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$image->setDateCreate(New \DateTime);
						$image->setDateModif(New \DateTime);
						$validator = $this->get('validator');
						$listErrors = $validator->validate($image);
						if(count($listErrors) > 0) 
						{
							return new Response((string) $listErrors);
						} 
						
						$tournoi = $em
						->getRepository('GACoreBundle:Tournoi')
						->find($id);
						
						$listeRonde = $tournoi->getRondes();
					
						$numero = $num - 1;
						$ronde = $listeRonde[$numero];
					
						$ronde->addImage($image);
						
						$em->persist($image);
						$em->flush();

            return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
        }

        return $this->render('GACoreBundle:Tournoi:addImage.html.twig', array(
            'form' => $form->createView(),
        ));
		}
		
		public function addRondeResultatAction($id, $num, Request $request)
		{
				$resultat = new Resultat();
        $form = $this->createForm(ResultatAddType::class, $resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$resultat->setDateCreate(New \DateTime);
						$resultat->setDateModif(New \DateTime);
						$validator = $this->get('validator');
						$listErrors = $validator->validate($resultat);
						if(count($listErrors) > 0) 
						{
							return new Response((string) $listErrors);
						} 
						
						$tournoi = $em
						->getRepository('GACoreBundle:Tournoi')
						->find($id);
						
						$listeRonde = $tournoi->getRondes();
					
						$numero = $num - 1;
						$ronde = $listeRonde[$numero];
					
						$ronde->addResultat($resultat);
						
						$em->persist($resultat);
						$em->flush();

            return $this->redirectToRoute('ga_core_tournoi_id_admin', array('id' => $id));
        }

        return $this->render('GACoreBundle:Tournoi:addResultat.html.twig', array(
            'form' => $form->createView(),
        ));
		}
				
			// EDITIONS
				
		public function editRondeLienAction($id, $num, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
						->getRepository('GACoreBundle:Lien')
						->find($idR);
						
			$form   = $this->container->get('form.factory')->create(lienAddType::class, $lien);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){ 
				
					$lien->setDateModif(New \DateTime);
					$validator = $this->get('validator');
					$listErrors = $validator->validate($lien);
					if(count($listErrors) > 0) 
					{
						return new Response((string) $listErrors);
					} 
					$em->persist($lien);
					$em->flush();
					
					if ($lien === null)
					{
						throw new NotFoundHttpException("Le lien ".$idr."n\'existe pas.");
					}
					
					$request->getSession()->getFlashBag()->add('notice', 'Lien bien enregistré.');

					return $this->redirectToRoute('ga_core_admin');
					
			}
			
			return $this->render('GACoreBundle:Tournoi:editLien.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		
			// SUPPRESSIONS
			
		public function deleteRondeLienAction($id, $num, $idR, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$lien = $em
					->getRepository('GACoreBundle:Lien')
					->find($idR);
					
			if ($lien === null)
			{
				throw new NotFoundHttpException("le lien ".$idR."n'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create(DeleteType::class, $lien);
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
			{
				$em->remove($lien);						
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "Le lien a bien été supprimée.");
				
				return $this->redirectToRoute('ga_core_admin');
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteLien.html.twig', array(
      'lien' => $lien,
      'form'   => $form->createView(),
			));
		}
	
		public function deleteRondeImageAction($id, $idR, $num,  Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$image = $em
					->getRepository('GACoreBundle:Image')
					->find($idR);
								
			if ($image === null){
				throw new NotFoundHttpException("l\'image d'id".$idR."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($image);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L\'image a bien été supprimé.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteImage.html.twig', array(
      'image' => $image,
			'id' => $id,
			'num' => $num,
      'form'   => $form->createView(),
			));
			
		}
		
		public function deleteRondeResultatAction($idR, $id, $num, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$resultat = $em
					->getRepository('GACoreBundle:Resultat')
					->find($idR);
								
			if ($resultat === null){
				throw new NotFoundHttpException("le resultat d'id".$idR."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($resultat);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Le resultat a bien été supprimé.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:Tournoi:deleteResultat.html.twig', array(
      'resultat' => $resultat,
			'id' => $id,
			'num' => $num,
      'form'   => $form->createView(),
			));
			
		}
		
			// TEST
			
		public function TestAction($id, Request $request)
		{
			
			$em = $this->getDoctrine()->getManager();
			$tournoi = $em
							-> getRepository('GACoreBundle:Tournoi')
							-> find($id);
				
						
			$saison = $tournoi->getSaison();
			
			var_dump($saison);
			exit();
			
			return $this->render('GACoreBundle:Tournoi:test.html.twig', array(
			'tournoi' => $tournoi,
			));
			
		}
		
			// INCLUSION BARRE DE NAVIGATION
			
		public function navAdulteAction()
		{
			 $repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Tournoi');
			
			$jeune = false;
			$listeSaison  = $repository->findListeSaison($jeune);		
			
			
			foreach($listeSaison as $key => $saisonArray)
			{
				
				$saison = $saisonArray['saison'];
				$listeTournoi[$saison] = $repository->findTournoiBySaisonAdulte($saison);
			}
			
			if(isset($listeTournoi)) 
			{
					return $this->render('GACoreBundle:Tournoi:navAdulte.html.twig', array(
																														'listeTournoi'=> $listeTournoi
																														));
			}
						
			return  $this->render('GACoreBundle:Tournoi:nav.html.twig');
			 
																														
		}
		
		public function navJeuneAction()
		{
			  $repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Tournoi');
			
			$jeune = true;
			$listeSaison  = $repository->findListeSaison($jeune);

					
			foreach($listeSaison as $key => $saisonArray)
			{
				
				$saison = $saisonArray['saison'];
				$listeTournoi[$saison] = $repository->findTournoiBySaisonJeune($saison);
			}
			
			if(isset($listeTournoi)) 
			{
									
				return $this->render('GACoreBundle:Tournoi:navJeune.html.twig', array(
																														'listeTournoi'=> $listeTournoi
																														));
			}
			
			return  $this->render('GACoreBundle:Tournoi:nav.html.twig');
			
		}
		
		
}
