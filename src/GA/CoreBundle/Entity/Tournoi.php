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
}
