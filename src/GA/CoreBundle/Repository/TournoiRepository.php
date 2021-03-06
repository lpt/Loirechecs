<?php

namespace GA\CoreBundle\Repository;

/**
 * TournoiRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournoiRepository extends \Doctrine\ORM\EntityRepository
{
	public function findListeSaison($jeune)
	{
		$qb = $this->createQueryBuilder('t')->select('t.saison')->distinct(true);
		
		$qb->where('t.jeune = :jeune')
							->setParameter('jeune', $jeune)
		;
		
		return $qb->getQuery()->getArrayResult();
		
	}
	
	public function findTournoiBySaisonAdulte($saison)
	{
		$qb = $this->createQueryBuilder('t')->select('t.id','t.nom');
		
		$qb->where('t.saison = :saison')
								->setParameter('saison', $saison)
					->andwhere('t.jeune = :jeune')
								->setParameter('jeune', false)
		;
		
		return $qb->getQuery()->getArrayResult();
		}
		
		public function findTournoiBySaisonJeune($saison)
	{
		$qb = $this->createQueryBuilder('t')->select('t.id','t.nom');
		
		$qb->where('t.saison = :saison')
								->setParameter('saison', $saison)
					->andwhere('t.jeune = :jeune')
								->setParameter('jeune', true)
		;
		
		return $qb->getQuery()->getArrayResult();
		}
		
		public function getIdLien($id)
		{
			$qb = $this->createQueryBuilder('t');
			
			$qb ->innerJoin('t.lien', 'l')
						->addSelect('l');
						
			return $qb->getQuery()->getArrayResult();
			
		}
		
		public function findTournoiByRonde(Array $ronde)
		{
			$qb = $this->createQueryBuilder('t');

   
    $qb
      ->join('t.rondes', 'r')
      ->addSelect('r')
    ;

    $qb->where($qb->expr()->in('r.id', $ronde));
    
    return $qb
      ->getQuery()
      ->getResult();
		}
}


