<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tournoi
 *
 * @ORM\Table(name="tournoi")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\TournoiRepository")
 */
class Tournoi
{
		
   
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Ronde", cascade={"persist", "remove"})
		* @Assert\Valid()
		*/
		private $rondes; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Lien", cascade={"persist", "remove"})
		* @Assert\Valid()
		*/
		private $liens; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Resultat", cascade={"persist", "remove"})
		* @Assert\Valid()
		*/
		private $resultats; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Affiche", cascade={"persist", "remove"})
		* @Assert\Valid()
		*/
		private $affiches; 
		
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
     * @ORM\Column(name="nom", type="string", length=255)
		 * @Assert\length(
		 * 							min=4, minMessage = "{{limit}} caractères minimun",
     *								max=25, maxMessage = "{{limit}} caractères maxium")
		 *@Assert\NotBlank(message = "Nom requis")
		 */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
		 * @Assert\length(
     *								max=255, maxMessage = "{{limit}} caractères maxium")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contactNom", type="string", length=255)
		 * @Assert\length(
		 * 							min=4, minMessage = "{{limit}} caractères minimun",
     *								max=25, maxMessage = "{{limit}} caractères maxium")
     */
    private $contactNom;

    /**
     * @var string
     *
     * @ORM\Column(name="contactTph", type="string", length=255)
		 * @Assert\length(
		 * 							min=10, minMessage = " {{ limit }} caractères minimun",
     *								max=14, maxMessage = " {{ limit }} caractères maxium")
     */
    private $contactTph;

    /**
     * @var string
     *
     * @ORM\Column(name="contactMail", type="string", length=255)
		 *@Assert\Email(message = "Email {{ value }}  non valide")
     */
    private $contactMail;
		
		 /**
     * @var string
     *
     * @ORM\Column(name="saison", type="string", length=255)
		 * @Assert\length(
		 * 							min=9,
     *								max=9, exactMessage = " {{ limit }} caractères maxium")
		 *@Assert\NotBlank(message="Saison requise")
		 */
		private $saison;
		
		/**
		*@var boolean
		*
		*@ORM\Column(name="jeune", type="boolean", options={"default":0})
		*@Assert\Type(type="boolean", message=" {{ value }} n'est pas du type {{ type }}")
		*/
		private $jeune;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Tournoi
     */
    public function setNom($nom)
    {
       
			 $this->nom = mb_strtoupper($nom, 'UTF-8');

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
     * Set description
     *
     * @param string $description
     *
     * @return Tournoi
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set contactNom
     *
     * @param string $contactNom
     *
     * @return Tournoi
     */
    public function setContactNom($contactNom)
    {
        $this->contactNom = $contactNom;

        return $this;
    }

    /**
     * Get contactNom
     *
     * @return string
     */
    public function getContactNom()
    {
        return $this->contactNom;
    }

    /**
     * Set contactTph
     *
     * @param string $contactTph
     *
     * @return Tournoi
     */
    public function setContactTph($contactTph)
    {
        $this->contactTph = $contactTph;

        return $this;
    }

    /**
     * Get contactTph
     *
     * @return string
     */
    public function getContactTph()
    {
        return $this->contactTph;
    }

    /**
     * Set contactMail
     *
     * @param string $contactMail
     *
     * @return Tournoi
     */
    public function setContactMail($contactMail)
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    /**
     * Get contactMail
     *
     * @return string
     */
    public function getContactMail()
    {
        return $this->contactMail;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rondes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ronde
     *
     * @param \GA\CoreBundle\Entity\Ronde $ronde
     *
     * @return Tournoi
     */
    public function addRonde(\GA\CoreBundle\Entity\Ronde $ronde)
    {
        $this->rondes[] = $ronde;

        return $this;
    }

    /**
     * Remove ronde
     *
     * @param \GA\CoreBundle\Entity\Ronde $ronde
     */
    public function removeRonde(\GA\CoreBundle\Entity\Ronde $ronde)
    {
        $this->rondes->removeElement($ronde);
    }

    /**
     * Get rondes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRondes()
    {
        return $this->rondes;
    }

    /**
     * Add lien
     *
     * @param \GA\CoreBundle\Entity\Lien $lien
     *
     * @return Tournoi
     */
    public function addLien(\GA\CoreBundle\Entity\Lien $lien)
    {
        $this->liens[] = $lien;

        return $this;
    }

    /**
     * Remove lien
     *
     * @param \GA\CoreBundle\Entity\Lien $lien
     */
    public function removeLien(\GA\CoreBundle\Entity\Lien $lien)
    {
        $this->liens->removeElement($lien);
    }

    /**
     * Get liens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiens()
    {
        return $this->liens;
    }

    /**
     * Add resultat
     *
     * @param \GA\CoreBundle\Entity\Resultat $resultat
     *
     * @return Tournoi
     */
    public function addResultat(\GA\CoreBundle\Entity\Resultat $resultat)
    {
        $this->resultats[] = $resultat;

        return $this;
    }

    /**
     * Remove resultat
     *
     * @param \GA\CoreBundle\Entity\Resultat $resultat
     */
    public function removeResultat(\GA\CoreBundle\Entity\Resultat $resultat)
    {
        $this->resultats->removeElement($resultat);
    }

    /**
     * Get resultats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultats()
    {
        return $this->resultats;
    }
		
		
    /**
     * Add affiche
     *
     * @param \GA\CoreBundle\Entity\Affiche $affiche
     *
     * @return Tournoi
     */
    public function addAffich(\GA\CoreBundle\Entity\Affiche $affiche)
    {
        $this->affiches[] = $affiche;

        return $this;
    }

    /**
     * Remove affiche
     *
     * @param \GA\CoreBundle\Entity\Affiche $affiche
     */
    public function removeAffich(\GA\CoreBundle\Entity\Affiche $affiche)
    {
        $this->affiches->removeElement($affiche);
    }

    /**
     * Get affiches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffiches()
    {
        return $this->affiches;
    }
		
		
    /**
     * Set saison
     *
     * @param string $saison
     *
     * @return Tournoi
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return string
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set jeune
     *
     * @param boolean $jeune
     *
     * @return Tournoi
     */
    public function setJeune($jeune)
    {
        $this->jeune = $jeune;

        return $this;
    }

    /**
     * Get jeune
     *
     * @return boolean
     */
    public function getJeune()
    {
        return $this->jeune;
    }
}
