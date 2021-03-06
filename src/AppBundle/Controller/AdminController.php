<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Base controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller {
    
    /**
     *
     * @Route("/", name="admin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('base'));
    }
}
