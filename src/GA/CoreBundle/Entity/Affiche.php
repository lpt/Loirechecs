<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Affiche
 *
 * @ORM\Table(name="affiche")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\AfficheRepository")
 */
class Affiche
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
     * @ORM\Column(name="dateCreate", type="datetimetz")
		 * @Assert\DateTime(message= "DateTime non valide")
		 */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetimetz")
		 * @Assert\DateTime(message= "DateTime non valide")
     */
    private $dateModif;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
		 * @Assert\length(
		 * 							min=4, minMessage = "{{limit}} caractères minimun",
     *								max=25, maxMessage = "{{limit}} caractères maxium")
		 * @Assert\NotBlank(message = "Nom requis")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin", type="string", length=255)
		 */
    private $chemin;
		
		private $cheminTemp;


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
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Affiche
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
     * @return Affiche
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
     * @return Affiche
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
     * Set chemin
     *
     * @param string $chemin
     *
     * @return Affiche
     */
    public function setChemin($chemin)
    {
        $this->chemin = $chemin;

        return $this;
    }

    /**
     * Get chemin
     *
     * @return string
     */
    public function getChemin()
    {
        return $this->chemin;
    }
		
		/**
     * Set cheminTemp
     *
     * @param string $cheminTemp
     *
     * @return Resultat
     */
    public function setCheminTemp($cheminTemp)
    {
        $this->cheminTemp = $cheminTemp;

        return $this;
    }

    /**
     * Get cheminTemp
     *
     * @return string
     */
    public function getCheminTemp()
    {
        return $this->cheminTemp;
    }
}

