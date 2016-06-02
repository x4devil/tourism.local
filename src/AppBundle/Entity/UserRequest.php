<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table(name="request", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class UserRequest {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $user;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="pay", type="boolean", nullable=false)
     */
    private $pay;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param \AppBundle\Entity\User $user
     * @return UserRequest
     */
    public function setUser(\AppBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * @return boolean
     */
    public function getPay() {
        return $this->pay;
    }
    
    /**
     * 
     * @param type boolean
     */
    public function setPay($pay) {
        $this->pay = $pay;
    }

}
