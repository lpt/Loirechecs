<?php

namespace GA\CoreBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use GA\CoreBundle\Entity\Product;
use GA\CoreBundle\FileUploader\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class BrochureUploadListener
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
		if (!$entity instanceof Product)
		{
			return;
		}
		
		$file = $entity->getBrochure();
		
		if(!$file instanceof UploadedFile)
		{
			return;
		}
		
		$fileName = $this->uploader->upload($file);
		$entity->setBrochure($fileName);
		
	}
	
	public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $fileName = $entity->getBrochure();

        $entity->setBrochure(new File($this->targetPath.'/'.$fileName));
    }
	
}