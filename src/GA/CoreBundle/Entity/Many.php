<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Many
 *
 * @ORM\Table(name="many")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\ManyRepository")
 */
class Many
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
     * @ORM\Column(name="champs", type="string", length=255)
     */
    private $champs;


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
     * Set champs
     *
     * @param string $champs
     *
     * @return Many
     */
    public function setChamps($champs)
    {
        $this->champs = $champs;

        return $this;
    }

    /**
     * Get champs
     *
     * @return string
     */
    public function getChamps()
    {
        return $this->champs;
    }
}

