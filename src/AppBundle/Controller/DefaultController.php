<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * Method("GET")
     * @Template()
     */
    public function toursAction($pageId, Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        $inPage = 2;
        if($pageId == 1){
                $offset = 0;
        } else {
                $offset = ($pageId-1) * $inPage;
        }
        
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $categoryId = $request->get('categoryId');

        if($categoryId != null){
            $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(array('id' => $categoryId));
        }
        
        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findBy(array('category' => $category));
        
        $pageCount = count($tours);
        if($pageCount != 0) {
                if($pageCount % $inPage == 0){
                        $pageCount = (int)($pageCount / $inPage);
                } else {
                        $pageCount = (int)($pageCount / $inPage + 1);
                }
        }
        
        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findBy(
                array('category' => $category),
                array(),
                $inPage,
                $offset);
        
        return $this->render('default/tours.html.twig', array(
                            'categories' => $categories,
                            'tours' => $tours,
                            'activeNav' => 3,
                            'pageCount' => $pageCount,
                            'activePage' => $pageId,
                            'categoryActive' => $categoryId,
                ));
    }
    /**
     * @Route("/services/page{pageId}")
     */
    public function servicesAction($pageId)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        $inPage = 2;
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
    /**
     * @Route("/tour{id}")
     */
    public function showTour($id)
    {
        $tour = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($id);
              
        return $this->render('default/tour.html.twig', array(
                            'tour' => $tour
        ));
    }
    
    /**
     * @Route("/service{id}")
     */
    public function showService($id)
    {
        $service = $this->getDoctrine()->getRepository('AppBundle:Service')->find($id);
              
        return $this->render('default/service.html.twig', array(
                            'service' => $service
        ));
    }
    
    /**
     * @Route("/cart")
     */
    public function showCart()
    {
              
        return $this->render('default/cart.html.twig', array());
    }
}
