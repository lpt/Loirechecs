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
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Lien", cascade={"persist", "remove"})
		*/
		private $liens; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Resultat", cascade={"persist", "remove"})
		*/
		private $resultats; 

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
        $this->liens = new \Doctrine\Common\Collections\ArrayCollection();
				$this->resultats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lien
     *
     * @param \GA\CoreBundle\Entity\lien $lien
     *
     * @return Ronde
     */
    public function addlien(\GA\CoreBundle\Entity\lien $lien)
    {
        $this->liens[] = $lien;

        return $this;
    }

    /**
     * Remove lien
     *
     * @param \GA\CoreBundle\Entity\lien $lien
     */
    public function removelien(\GA\CoreBundle\Entity\lien $lien)
    {
        $this->liens->removeElement($lien);
    }

    /**
     * Get liens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getliens()
    {
        return $this->liens;
    }
		
		/**
     * Add resultat
     *
     * @param \GA\CoreBundle\Entity\resultat $resultat
     *
     * @return Ronde
     */
    public function addresultat(\GA\CoreBundle\Entity\resultat $resultat)
    {
        $this->resultats[] = $resultat;

        return $this;
    }

    /**
     * Remove resultat
     *
     * @param \GA\CoreBundle\Entity\resultat $resultat
     */
    public function removeresultat(\GA\CoreBundle\Entity\resultat $resultat)
    {
        $this->resultats->removeElement($resultat);
    }

    /**
     * Get resultats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getresultats()
    {
        return $this->resultats;
    }
		
		
}
