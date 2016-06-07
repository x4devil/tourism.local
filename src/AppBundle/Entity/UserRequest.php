<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRequest
 *
 * @IgnoreAnnotation("fn")
 * @ORM\Table(name="request")
 * @ORM\Entity
 */
class UserRequest
{
    /**
     * @var boolean
     */
    private $pay;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Tour", mappedBy="userrequest", cascade={"persist", "remove"})
     */
    private $tours;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Service", mappedBy="userrequest", cascade={"persist", "remove"})
     */
    private $services;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set pay
     *
     * @param boolean $pay
     * @return UserRequest
     */
    public function setPay($pay)
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * Get pay
     *
     * @return boolean 
     */
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return UserRequest
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add tours
     *
     * @param \AppBundle\Entity\Tour $tours
     * @return UserRequest
     */
    public function addTour(\AppBundle\Entity\Tour $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove tours
     *
     * @param \AppBundle\Entity\Tour $tours
     */
    public function removeTour(\AppBundle\Entity\Tour $tours)
    {
        $this->tours->removeElement($tours);
    }

    /**
     * Get tours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * Add services
     *
     * @param \AppBundle\Entity\Service $services
     * @return UserRequest
     */
    public function addService(\AppBundle\Entity\Service $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \AppBundle\Entity\Service $services
     */
    public function removeService(\AppBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }
}
