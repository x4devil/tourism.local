<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        return $this->render('default/index.html.twig', array(
                            'categories' => $categories
        ));
    }
    
    /**
     * @Route("/tours/page{pageId}")
     */
    public function toursAction($pageId)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        $inPage = 1;
        if($pageId == 1){
                $offset = 0;
        } else {
                $offset = ($pageId-1) * $inPage;
        }

        $pageCount = count($tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findAll());
        if($pageCount != 0) {
                if($pageCount % $inPage == 0){
                        $pageCount = (int)($pageCount / $inPage);
                } else {
                        $pageCount = (int)($pageCount / $inPage + 1);
                }
        }
        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findBy(array(),array(),$inPage,$offset);
        
        return $this->render('default/tours.html.twig', array(
                            'categories' => $categories,
                            'tours' => $tours,
                            'activeNav' => 3,
                            'pageCount' => $pageCount,
                            'activePage' => $pageId
        ));
    }
    /**
     * @Route("/services/page{pageId}")
     */
    public function servicesAction($pageId)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        $inPage = 6;
        if($pageId == 1){
                $offset = 0;
        } else {
                $offset = ($pageId-1) * $inPage;
        }

        $pageCount = count($services = $this->getDoctrine()->getRepository('AppBundle:Service')->findAll());
        if($pageCount != 0) {
                if($pageCount % $inPage == 0){
                        $pageCount = (int)($pageCount / $inPage);
                } else {
                        $pageCount = (int)($pageCount / $inPage + 1);
                }
        }
        $services = $this->getDoctrine()->getRepository('AppBundle:Service')->findBy(array(),array(),$inPage,$offset);
        
        return $this->render('default/services.html.twig', array(
                            'categories' => $categories,
                            'services' => $services,
                            'activeNav' => 2,
                            'pageCount' => $pageCount,
                            'activePage' => $pageId
        ));
    }
}
