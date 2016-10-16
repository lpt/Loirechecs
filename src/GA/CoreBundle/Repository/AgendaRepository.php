<?php

namespace GA\CoreBundle\Repository;

/**
 * AgendaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgendaRepository extends \Doctrine\ORM\EntityRepository
{
	public function findListeSaison()
	{
		$qb = $this->createQueryBuilder('a')->select('a.saison')->distinct(true);
		
		$qb->groupBy('a.saison');
				
		return $qb->getQuery()->getArrayResult();
		
	}
	
		public function findAgendaBySaison($saison)
	{
		$qb = $this->createQueryBuilder('a');
		
		$qb->where('a.saison = :saison')
								->setParameter('saison', $saison)
		;
		
		return $qb->getQuery()->getResult();
		}
}
