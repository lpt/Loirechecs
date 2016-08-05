<?php

namespace GA\CoreBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use GA\CoreBundle\Entity\Image;
use GA\CoreBundle\FileUploader\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class ImageUploadListener
{
	private $uploader;
	
	public function __construct(FileUploader $uploader)
	{
		$this->uploader = $uploader;
	}
	
	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		
		$this->uploadFile($entity);
	}
	
	public function preUpdate(PreUpdateEventArgs $args)
	{
		$entity = $args->getEntity();
		
		$this->uploadFile($entity);
	}
	
	private function uploadFile($entity)
	{
		if (!$entity instanceof Image)
		{
			return;
		}
		
		$file = $entity->getChemin();
		
		if(!$file instanceof UploadedFile)
		{
			return;
		}
		
		$fileName = $this->uploader->upload($file);
		$entity->setChemin($fileName);

		
	}
	
	public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
				
				if(!$entity instanceof Tournoi OR !$entity instanceof Ronde)
				{
					return;
				}

        $fileName = $entity->getChemin();

        $entity->setChemin(new File('/uploads/image/'.$fileName));
    }
		
	public function preRemove(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		

				
				if(!$entity instanceof Image)
				{
					return;
				}
				
		// stocke l'adresse du fichier avant la suppression de l'id
		$fileName = $entity->getChemin();
		
		$fileName = 'uploads/image/'.$fileName;
		
		
		$entity->setCheminTemp(new File($fileName));
		
	
	}
	
	public function postRemove(LifecycleEventArgs $args)
	{
		
		$entity = $args->getEntity();
				
				if(!$entity instanceof Image)
				{
					return;
				}
			
		
		// récupère l'adresse du fichier de l'entité supprimé et supprime le fichier
		$tempFile = $entity->getCheminTemp();
		
				
		if (file_exists($tempFile))
		{		
      unlink($tempFile);
    }
	}
	
}