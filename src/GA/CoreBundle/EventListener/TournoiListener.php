<?php

namespace GA\CoreBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use GA\CoreBundle\Entity\Tournoi;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class TournoiListener
{
		
	public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
				
				if(!$entity instanceof Tournoi)
				{
					return;
				}

        $saison = $entity->createSaison();
				
				$entity->setSaison($saison);

		}
}