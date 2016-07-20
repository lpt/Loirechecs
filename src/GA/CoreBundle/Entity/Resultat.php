<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultat
 *
 * @ORM\Table(name="resultat")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\ResultatRepository")
 */
class Resultat
{		
		/**
		 *@ORM\OneToOne(targetEntity="GA\CoreBundle\Entity\Ressource", mappedBy="Resultat")
		 */
		private $ressource;
		
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var int
     *
     * @ORM\Column(name="taille", type="integer")
     */
    private $taille;
		
		private $file;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Resultat
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set taille
     *
     * @param integer $taille
     *
     * @return Resultat
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }
		
		
		public function setFile(UpdloadedFile $file = null)
		{
			$this->file = $file;
		}
		
		public function getFile()
		{
			return $this->file;
		}
		

    /**
     * Set ressource
     *
     * @param \GA\CoreBundle\Entity\Ressource $ressource
     *
     * @return Resultat
     */
    public function setRessource(\GA\CoreBundle\Entity\Ressource $ressource = null)
    {
        $this->ressource = $ressource;

        return $this;
    }

    /**
     * Get ressource
     *
     * @return \GA\CoreBundle\Entity\Ressource
     */
    public function getRessource()
    {
        return $this->ressource;
    }
		
		public function upload()
		{
			// Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
			if (null === $this->file) {
      return;
			}

			// On récupère le nom original du fichier de l'internaute
			$name = $this->file->getClientOriginalName();

			// On déplace le fichier envoyé dans le répertoire de notre choix
			$this->file->move($this->getUploadRootDir(), $name);

			// On sauvegarde le nom de fichier dans notre attribut $url
			//$this->url = $name;
			$this->setRessource()->setUrl($name);
	
			// On crée également le futur attribut alt de notre balise <img>
			//$this->alt = $name;
			$this->setRessource()->setNom($name);
		}

		public function getUploadDir()
		{
			// On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
			return 'uploads/img';
		}

		protected function getUploadRootDir()
		{
			// On retourne le chemin relatif vers l'image pour notre code PHP
			return __DIR__.'/../../../../web/'.$this->getUploadDir();
		}
}
