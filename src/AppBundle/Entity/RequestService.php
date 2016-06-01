<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestService
 *
 * @ORM\Table(name="request_service")
 * @ORM\Entity
 */
class RequestService {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_request", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $request;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $service;

    /**
     * Set idRequest
     *
     * @param integer $request
     * @return RequestService
     */
    public function setRequest($request) {
        $this->request = $request;

        return $this;
    }

    /**
     * Get idRequest
     *
     * @return integer 
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Set idService
     *
     * @param integer $service
     * @return RequestService
     */
    public function setService($service) {
        $this->service = $service;

        return $this;
    }

    /**
     * Get idService
     *
     * @return integer 
     */
    public function getService() {
        return $this->service;
    }

}
