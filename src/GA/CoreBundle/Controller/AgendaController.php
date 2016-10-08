<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GA\CoreBundle\Entity\Agenda;
use GA\CoreBundle\Form\AgendaType;

class AgendaController extends Controller
{
    public function indexAction()
    {
			if(isset($_GET['pdf']) and $_GET['pdf'] == true)
			{
				$this->creePdf();
				
				return $this->render('GACoreBundle:Agenda:index.html.twig');
			}
			
				$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Agenda');
			
			
			$listeAgenda  = $repository->findAll();
			
       return $this->render('GACoreBundle:Agenda:index.html.twig', array('listeAgenda' => $listeAgenda));
    }
		
		public function adminAction()
    {
				$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Agenda');
			
			$listeAgenda  = $repository->findAll();
			
       return $this->render('GACoreBundle:Agenda:admin.html.twig', array('listeAgenda' => $listeAgenda));
    }
		
		public function addAction(Request $request)
		{
			$agenda = new Agenda();
			$form   = $this->get('form.factory')->create(agendaType::class, $agenda);

			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				
				$em = $this->getDoctrine()->getManager();
				$em->persist($agenda);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Date bien enregistrée.');

				return $this->redirectToRoute('ga_core_agenda', array('id' => $agenda->getId()));
			}

			return $this->render('GACoreBundle:Agenda:add.html.twig', array(
				'form' => $form->createView(),
     ));
		}
		
		public function editAction()
		{
			return $this->render('GACoreBundle:Agenda:edit.html.twig');
		}
		
		public function deleteAction()
		{
			return $this->render('GACoreBundle:Agenda:delete.html.twig');
		}
		
		public function creerPdf()
		{
			return;
		}
		
		public function navAction()
		{
			 $repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Agenda');
			
			$listeSaison  = $repository->findListeSaison();		
			
			
			
			if(isset($listeSaison)) 
			{
					return $this->render('GACoreBundle:Agenda:nav.html.twig', array(
																														'listeSaison'=> $listeSaison
																														));
			}
						
			return  $this->render('GACoreBundle:Agenda:nav.html.twig');
			 
																														
		}
}
