<?php 

namespace GA\CoreBundle\Stock;

class Calendrier
{
		private $nom;
		private $adresse;
		private $ville;
		
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
		
}