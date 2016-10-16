<?php 

namespace GA\CoreBundle\Stock;

use GA\CoreBundle\Formatage\DateFormat;

class Calendrier
{
		private $nom;
		private $adresse;
		private $ville;
		private $contactNom;
    private $contactTph;
    private $contactMail;
		private $dateEvent;
		private $description;
		private $dateEventTime;
		private $jourEvent;
		private $moisEvent;
		
		
		public function getNom()
		{
			 return $this->nom;
		}
		
		public function getAdresse()
		{
			 return $this->adresse;
		}
		
		public function getVille()
		{
			 return $this->ville;
		}
		
		public function getContactNom()
		{
			 return $this->contactNom;
		}
		
		public function getContactMail()
		{
			 return $this->contactMail;
		}
		
		public function getContactTph()
		{
			 return $this->contactTph;
		}
		
		public function getDateEvent()
		{
			 return $this->dateEvent;
			 
		}
		
		public function getDescription()
		{
			 return $this->description;
		}
		
		public function getDateEventTime()
		{
			 return $this->dateEventTime;
			 
		}
		
		public function getJourEvent()
		{
			 return $this->jourEvent;
			 
		}
		
		public function getMoisEvent()
		{
			 return $this->moisEvent;
			 
		}
		
		public function setNom($nom)
		{
			 $this->nom = $nom;
		}
		
		public function setAdresse($adresse)
		{
			 $this->adresse = $adresse;
		}
		
		public function setVille($ville)
		{
			 $this->ville =  $ville;
		}
		
		public function setContactNom($contactNom)
		{
			 $this->contactNom =  $contactNom;
		}
		
		public function setContactMail($contactMail)
		{
			 $this->contactMail =  $contactMail;
		}
		
		public function setContactTph($contactTph)
		{
			 $this->contactTph =  $contactTph;
		}
		
		public function setDateEvent($dateEvent)
		{
			 $this->dateEvent =  $dateEvent;
			 
			 $dateEventTime = $dateEvent->getTimestamp();
			 
			 $this->setDateEventTime($dateEventTime);		 	 	
		 		
			$this->setJourEvent(DateFormat::getJour($dateEvent));
			
			$this->setMoisEvent(DateFormat::getMois($dateEvent));
								
			 
		}
		
		public function setDescription($description)
		{
			 $this->description =  $description;
		}
		
		public function setDateEventTime($dateEventTime)
		{
			 $this->dateEventTime =  $dateEventTime;
		}
		
		public function setJourEvent($jourEvent)
		{
			 $this->jourEvent =  $jourEvent;
		}
		
		public function setMoisEvent($moisEvent)
		{
			 $this->moisEvent =  $moisEvent;
		}
		
}