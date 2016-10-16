<?php 

namespace GA\CoreBundle\Formatage;

class DateFormat

{
		public function getJour($dateFormat)
	{
		
		$jourInt = intval(date_format($dateFormat, 'w'));
		$jourArray=array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
		$jour = $jourArray[$jourInt];
						
		return $jour;
		
	}
	
	public function getMois($dateFormat)
	{
		
		$moisInt = intval(date_format($dateFormat,'m'));
		$moisArray = array('','janvier','fevrier','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
		$mois = $moisArray[$moisInt];
						
		return $mois;
		
	}
	
}
