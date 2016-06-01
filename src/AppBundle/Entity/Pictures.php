<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pictures
 *
 * @ORM\Table(name="pictures", indexes={@ORM\Index(name="id_tour", columns={"id_tour"})})
 * @ORM\Entity
 */
class Pictures {

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="blob", length=65535, nullable=false)
     */
    private $file;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tour", referencedColumnName="id")
     * })
     */
    protected $tour;

    /**
     * Set file
     *
     * @param string $file
     * @return Pictures
     */
    public function setFile($file) {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile() {
        return $this->file;
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
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     * @return Pictures
     */
    public function setTour(\AppBundle\Entity\Tour $tour = null) {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \AppBundle\Entity\Tour 
     */
    public function getTour() {
        return $this->tour;
    }

}
