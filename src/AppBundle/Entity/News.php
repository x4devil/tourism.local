<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of News
 *
 * @author x4
 */
class News {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=500, nullable=false)
     */
    private $photo;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
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
     * @param string $description
     * @return News
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }
    
    /**
     * Set photo
     *
     * @param string $photo
     * @return Tour
     */
    public function setPhoto($photo) {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    function __toString() {
        return $this->getName();
    }

}
