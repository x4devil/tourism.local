<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @IgnoreAnnotation("fn")
 * @ORM\Table(name="tour", indexes={@ORM\Index(name="id_category", columns={"id_category"}), @ORM\Index(name="id_base", columns={"id_base"})})
 * @ORM\Entity
 */
class Tour {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_", type="text", length=65535, nullable=false)
     */
    private $desc;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=350, nullable=false)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_", type="date", nullable=false)
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date", nullable=false)
     */
    private $end;

    /**
     * @var integer
     *
     * @ORM\Column(name="places", type="integer", nullable=false)
     */
    private $places;

    /**
     * @var boolean
     *
     * @ORM\Column(name="empty", type="boolean", nullable=false)
     */
    private $empty;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

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
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     * })
     */
    protected $category;

    /**
     * @var \AppBundle\Entity\Base
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Base")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_base", referencedColumnName="id")
     * })
     */
    protected $base;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\UserRequest", mappedBy="tour")
     */
    protected $request;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="Pictures", mappedBy="tour")
     */
    protected $pictures;

    /**
     * Constructor
     */
    public function __construct() {
        $this->request = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tour
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
     * Set desc
     *
     * @param string $desc
     * @return Tour
     */
    public function setDesc($desc) {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDesc() {
        return $this->desc;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Tour
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set begin
     *
     * @param \DateTime $begin
     * @return Tour
     */
    public function setBegin($begin) {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime 
     */
    public function getBegin() {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Tour
     */
    public function setEnd($end) {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Set places
     *
     * @param boolean $places
     * @return Tour
     */
    public function setPlaces($places) {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer 
     */
    public function getPlaces() {
        return $this->places;
    }

    /**
     * Set empty
     *
     * @param boolean $empty
     * @return Tour
     */
    public function setEmpty($empty) {
        $this->empty = $empty;

        return $this;
    }

    /**
     * Get empty
     *
     * @return boolean 
     */
    public function getEmpty() {
        return $this->empty;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Tour
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
     * Set x
     *
     * @param float $x
     * @return Tour
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
     * @return Tour
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

    /**
     * Set idBase
     *
     * @param \AppBundle\Entity\Base $base
     * @return Tour
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

    /**
     * Add idRequest
     *
     * @param \AppBundle\Entity\UserRequest $request
     * @return Tour
     */
    public function addRequest(\AppBundle\Entity\UserRequest $request) {
        $this->request[] = $request;

        return $this;
    }

    /**
     * Remove idRequest
     *
     * @param \AppBundle\Entity\UserRequest $request
     */
    public function removeRequest(\AppBundle\Entity\UserRequest $request) {
        $this->request->removeElement($request);
    }

    /**
     * Get request
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * Add picture
     *
     * @param \AppBundle\Entity\Pictures $pictures
     * @return Tour
     */
    public function addPicture(\AppBundle\Entity\Pictures $pictures) {
        $this->pictures[] = $pictures;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Pictures $pictures
     */
    public function removePicture(\AppBundle\Entity\Pictures $pictures) {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures() {
        return $this->pictures;
    }

    function __toString() {
        return $this->getName();
    }

}
