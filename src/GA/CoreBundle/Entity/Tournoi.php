<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
		*/
		private $rondes; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Lien", cascade={"persist", "remove"})
		*/
		private $liens; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Resultat", cascade={"persist", "remove"})
		*/
		private $resultats; 
		
		/**
		* @ORM\ManyToMany(targetEntity="GA\CoreBundle\Entity\Affiche", cascade={"persist", "remove"})
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contactNom", type="string", length=255)
     */
    private $contactNom;

    /**
     * @var string
     *
     * @ORM\Column(name="contactTph", type="string", length=255)
     */
    private $contactTph;

    /**
     * @var string
     *
     * @ORM\Column(name="contactMail", type="string", length=255)
     */
    private $contactMail;


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
     * Add affich
     *
     * @param \GA\CoreBundle\Entity\Affiche $affich
     *
     * @return Tournoi
     */
    public function addAffich(\GA\CoreBundle\Entity\Affiche $affich)
    {
        $this->affiches[] = $affich;

        return $this;
    }

    /**
     * Remove affich
     *
     * @param \GA\CoreBundle\Entity\Affiche $affich
     */
    public function removeAffich(\GA\CoreBundle\Entity\Affiche $affich)
    {
        $this->affiches->removeElement($affich);
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
		
		public function getSaison()
		{
			$listeRonde = $this->getRondes();
			$ronde = $listeRonde[0];
			
			$dateEvent = $ronde->getDateEvent();
			
			$annee = $dateEvent->sub(new \DateInterval('P8M'));
			$annee1 = intval($annee->format('Y'));
			$annee2 = $annee1 + 1;
			$saison = $annee1." - ".$annee2;
			
			return $saison;
		}
}
