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
    public function indexAction($saison)
    {
			
			$repository = $this->getDoctrine()
					->getManager()
					->getRepository('GACoreBundle:Ronde');
			
			$saisonArray = array($saison);
			
			$rondes = $repository->findRondeBySaison($saisonArray);
			
			foreach($rondes as $ronde)
			{
				$tournois = $ronde->getTournois();
			
			foreach($tournois as $tournoi)
			{
			$nom = $tournoi->getNom();
			$description = $tournoi-> getDescription();
			$contactMail = $tournoi-> getContactMail();
			$contactTph = $tournoi-> getContactTph();
			$contactNom = $tournoi-> getContactNom();
			}
			
			$dateEvent = $ronde->getDateEvent();
			$adresse = $ronde->getAdresse();
			$numero = $ronde->getNumero();
			$ville = $ronde->getVille();
			$nomCal = $nom.' - Ronde N° '.$numero;
						
			$calendrier[] = new \GA\CoreBundle\Stock\Calendrier;
			end($calendrier)->setNom($nomCal);
			end($calendrier)	->setVille($ville);
			end($calendrier) ->setAdresse($adresse);
			end($calendrier) ->setContactNom($contactNom);
			end($calendrier) ->setContactMail($contactMail);
			end($calendrier) ->setContactTph($contactTph);
			end($calendrier) ->setDescription($description);
			end($calendrier) ->setDateEvent($dateEvent);
			
			}			
						
						
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('GACoreBundle:Agenda');
			
			$listeAgenda  = $repository->findAgendaBySaison($saison);
			
			foreach($listeAgenda as $agenda)
			{
				$adresseCal = $agenda->getAdresse();
				$villeCal = $agenda->getVille();
				$nomCal = $agenda->getNom();
				$contactNomCal = $agenda->getContactNom();
				$contactMailCal = $agenda->getContactMail();
				$contactTphCal = $agenda->getContactTph();
				$dateEventCal = $agenda->getDateEvent();
				$descriptionCal= $agenda->getDescription();
				
				$calendrier[] = new \GA\CoreBundle\Stock\Calendrier;
				end($calendrier)->setNom($nomCal);
				end($calendrier)	->setVille($villeCal);
				end($calendrier) ->setAdresse($adresseCal);
				end($calendrier) ->setContactNom($contactNomCal);
				end($calendrier) ->setContactTph($contactTphCal);
				end($calendrier) ->setContactMail($contactMailCal);
				end($calendrier) ->setDescription($descriptionCal);
				end($calendrier) ->setDateEvent($dateEventCal);
			}
			
			usort($calendrier, array('GA\CoreBundle\Controller\AgendaController','comparer'));
						
			 return $this->render('GACoreBundle:Agenda:test.html.twig', array('calendrier' => $calendrier));
			
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
			
			 return $this->render('GACoreBundle:Agenda:test.html.twig', array('calendrier' => $calendrier, 'saison' => $saison));
     
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
			
						
			 return $this->render('ga_core_annonce');
		}
		
		public function comparer($a, $b)
		{
						
			return gmp_cmp($a->getDateEventTime(), $b->getDateEventTime());
			
			;
		}
		
			
}
