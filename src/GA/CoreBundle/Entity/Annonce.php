<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreat", type="datetimetz")
     */
    private $dateCreat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetimetz", nullable=true)
     */
    private $dateModif;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
		 * @Assert\length(
		 * 							min=4, minMessage = "{{limit}} caractères minimun",
     *								max=50, maxMessage = "{{limit}} caractères maxium")
		 * @Assert\NotBlank(message = "Nom requis")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
		 * @Assert\length(
		 * 							min=4, minMessage = "{{limit}} caractères minimun",
     *								max=25, maxMessage = "{{limit}} caractères maxium")
		 * @Assert\NotBlank(message = "Nom requis")
     */
    private $auteur;

    /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text")
		 * @Assert\NotBlank(message = "Nom requis")
     */
    private $contenu;
		
				
		/**
     * @var string
     *
     * @ORM\Column(name="auteurModif", type="string", length=255, nullable=true)
     */
    private $auteurModif;
		
		/**
		*@var boolean
		*
		*@ORM\Column(name="publication", type="boolean", options={"default":0})
		*@Assert\Type(type="boolean", message=" {{ value }} n'est pas du type {{ type }}")
		*/
		private $publication;
		
		
		
		public function __construct()
		{
				$this->dateCreat = new \DateTime();
				$this->dateModif = new \DateTime();
		}


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
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Annonce
     */
    public function setDateCreat($dateCreat)
    {
        $this->datetime = $dateCreat;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDateCreat()
    {
        return $this->dateCreat;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Annonce
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Annonce
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param text $contenu
     *
     * @return Annonce
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return text
     */
    public function getContenu()
    {
        return $this->contenu;
    }
		
		
    /**
     * Set auteurModif
     *
     * @param string $auteurModif
     *
     * @return Annonce
     */
    public function setAuteurModif($auteurModif)
    {
        $this->auteurModif = $auteurModif;

        return $this;
    }

    /**
     * Get auteurModif
     *
     * @return string
     */
    public function getAuteurModif()
    {
        return $this->auteurModif;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     *
     * @return Annonce
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
