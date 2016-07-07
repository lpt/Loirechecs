<?php

namespace GA\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * One
 *
 * @ORM\Table(name="one")
 * @ORM\Entity(repositoryClass="GA\CoreBundle\Repository\OneRepository")
 */
class One
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
     * @ORM\Column(name="var", type="string", length=255)
     */
    private $var;


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
     * Set var
     *
     * @param string $var
     *
     * @return One
     */
    public function setVar($var)
    {
        $this->var = $var;

        return $this;
    }

    /**
     * Get var
     *
     * @return string
     */
    public function getVar()
    {
        return $this->var;
    }
}
