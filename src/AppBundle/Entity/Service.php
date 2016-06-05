<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="id_sublegal", columns={"id_sublegal"})})
 * @ORM\Entity
 */
class Service {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bases", type="boolean", nullable=true)
     */
    private $bases;

    /**
     * @var float
     *
     * @ORM\Column(name="x", type="float", precision=10, scale=0, nullable=false)
     */
    private $x;

    /**
     * @var float
     *
     * @ORM\Column(name="y", type="float", precision=10, scale=0, nullable=false)
     */
    private $y;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sublegal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sublegal", referencedColumnName="id")
     * })
     */
    private $sublegal;

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
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     * })
     */
    protected $category;

    /**
     * Set name
     *
     * @param string $name
     * @return Service
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Service
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Service
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set base
     *
     * @param boolean $bases
     * @return Service
     */
    public function setBases($bases) {
        $this->bases = $bases;

        return $this;
    }

    /**
     * Get base
     *
     * @return boolean 
     */
    public function getBases() {
        return $this->bases;
    }

    /**
     * Set x
     *
     * @param float $x
     * @return Service
     */
    public function setX($x) {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return float 
     */
    public function getX() {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param float $y
     * @return Service
     */
    public function setY($y) {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return float 
     */
    public function getY() {
        return $this->y;
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
     * Set idSublegal
     *
     * @param \AppBundle\Entity\Sublegal $sublegal
     * @return Service
     */
    public function setSublegal($sublegal = null) {
        $this->sublegal = $sublegal;

        return $this;
    }

    /**
     * Get idSublegal
     *
     * @return \AppBundle\Entity\Sublegal 
     */
    public function getSublegal() {
        return $this->sublegal;
    }

    /**
     * Set base
     *
     * @param \AppBundle\Entity\Base $base
     * @return Service
     */
    public function setBase($base = null) {
        $this->base = $base;

        return $this;
    }

    /**
     * Get idSublegal
     *
     * @return \AppBundle\Entity\Base 
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Set idCategory
     *
     * @param \AppBundle\Entity\Category $category
     * @return Tour
     */
    public function setCategory(\AppBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory() {
        return $this->category;
    }

    function __toString() {
        return $this->getName();
    }

}
