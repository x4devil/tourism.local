<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sublegal
 *
 * @ORM\Table(name="sublegal", indexes={@ORM\Index(name="id_base", columns={"id_base"}), @ORM\Index(name="id_base_2", columns={"id_base"})})
 * @ORM\Entity
 */
class Sublegal {

    /**
     * @var string
     *
     * @ORM\Column(name="fio", type="string", length=300, nullable=false)
     */
    private $fio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Base
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Base")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_base", referencedColumnName="id")
     * })
     */
    private $base;

    /**
     * Set fio
     *
     * @param string $fio
     * @return Sublegal
     */
    public function setFio($fio) {
        $this->fio = $fio;

        return $this;
    }

    /**
     * Get fio
     *
     * @return string 
     */
    public function getFio() {
        return $this->fio;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idBase
     *
     * @param \AppBundle\Entity\Base $base
     * @return Sublegal
     */
    public function setBase(\AppBundle\Entity\Base $base = null) {
        $this->base = $base;

        return $this;
    }

    /**
     * Get idBase
     *
     * @return \AppBundle\Entity\Base 
     */
    public function getBase() {
        return $this->base;
    }

    function __toString() {
        return $this->getFio();
    }

}
