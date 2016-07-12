<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ressource
 *
 * @ORM\Table(name="ressource")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\RessourceRepository")
 */
class Ressource
{
		/**
		* @ORM\OneToOne(targetEntity="GA\CoreBundle\Entity\Lien", cascade={"persist", "remove"})
		*/
		private $Lien;
		
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreate", type="datetimetz")
     */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetimetz")
     */
    private $dateModif;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


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
     * Set type
     *
     * @param int $type
     *
     * @return Ressource
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Ressource
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Ressource
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Ressource
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Ressource
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set lien
     *
     * @param \GA\CoreBundle\Entity\Lien $lien
     *
     * @return Ressource
     */
    public function setLien(\GA\CoreBundle\Entity\Lien $lien)
    {
        $this->Lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return \GA\CoreBundle\Entity\Lien
     */
    public function getLien()
    {
        return $this->Lien;
    }
}
