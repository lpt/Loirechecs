<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GA\CoreBundle\Entity\Agenda;
use GA\CoreBundle\Form\AgendaType;
//use GA\CoreBundle\Stock;

class AgendaController extends Controller
{
    public function indexAction($saison)
    {
			
				$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Agenda');
			
			
			$listeAgenda  = $repository->findAll();
			
			if(isset($_GET['pdf']) and $_GET['pdf'] == true)
			{									
				$html = $this->renderView('GACoreBundle:Agenda:pdf.html.twig', array(
												'listeAgenda'  => $listeAgenda
												));

				return new Response(
							$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
							200,
							array(
									'Content-Type'          => 'application/pdf',
									'Content-Disposition'   => 'attachment; filename="file.pdf"'
									)
									);
			}
			
			
       return $this->render('GACoreBundle:Agenda:index.html.twig', array('listeAgenda' => $listeAgenda, 'saison' => $saison));
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
		
		public function testAction()
		{
						
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Ronde');
			
			$saisonArray = array('2016-2017');
			$rondes = $repository->findRondeBySaison($saisonArray);
			
			foreach($rondes as $ronde)
			{
				$tournois = $ronde->getTournois();
			
			foreach($tournois as $tournoi)
			{
			$nom = $tournoi->getNom();
			}
			
			
			$adr = $ronde->getAdresse();
			$numero = $ronde->getNumero();
			$ville = $ronde->getVille();
			$nomCal = $nom.' - Ronde N° '.$numero;
						
			$calendrier[] = new \GA\CoreBundle\Stock\Calendrier;
			end($calendrier)->setNom($nomCal);
			end($calendrier)	->setVille($ville);
			end($calendrier) ->setAdresse($adr);
			
			}			
						
						
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Agenda');
			
			$listeAgenda  = $repository->findAll();
			
			foreach($listeAgenda as $agenda)
			{
				$adr = $agenda->getAdresse();
				$ville = $agenda->getVille();
				$nomCal = $agenda->getNom();
				
				$calendrier[] = new \GA\CoreBundle\Stock\Calendrier;
				end($calendrier)->setNom($nomCal);
				end($calendrier)	->setVille($ville);
				end($calendrier) ->setAdresse($adr);
			}
			
			usort($calendrier, array('GA\CoreBundle\Controller\AgendaController','comparer'));
						
			 return $this->render('GACoreBundle:Agenda:test.html.twig', array('calendrier' => $calendrier));
		}
		
		public function comparer($a, $b)
		{
			return strcmp($a->getNom(), $b->getNom());
		}
		
		
		
}
