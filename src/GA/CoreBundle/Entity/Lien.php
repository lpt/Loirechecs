<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lien
 *
 * @ORM\Table(name="lien")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\LienRepository")
 */
class Lien
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
     * @ORM\Column(name="url", type="string", length=255)
		 * @Assert\Url(message = "Url {{ value }} non valide")
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
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Lien
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
     * @return Lien
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
     * @return Lien
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
     * @return Lien
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
}

