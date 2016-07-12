<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ronde
 *
 * @ORM\Table(name="ronde")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\RondeRepository")
 */
class Ronde
{		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Ressource", cascade={"persist", "remove"})
		*/
		private $ressources; 

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
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="datetime")
     */
    private $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;


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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Ronde
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     *
     * @return Ronde
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Ronde
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Ronde
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ressources = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ressource
     *
     * @param \GA\CoreBundle\Entity\Ressource $ressource
     *
     * @return Ronde
     */
    public function addRessource(\GA\CoreBundle\Entity\Ressource $ressource)
    {
        $this->ressources[] = $ressource;

        return $this;
    }

    /**
     * Remove ressource
     *
     * @param \GA\CoreBundle\Entity\Ressource $ressource
     */
    public function removeRessource(\GA\CoreBundle\Entity\Ressource $ressource)
    {
        $this->ressources->removeElement($ressource);
    }

    /**
     * Get ressources
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRessources()
    {
        return $this->ressources;
    }
}
