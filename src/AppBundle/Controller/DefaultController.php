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
     * Method("GET")
     * @Template()
     */
    public function servicesAction($pageId, Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        
        $inPage = 2;
        if($pageId == 1){
                $offset = 0;
        } else {
                $offset = ($pageId-1) * $inPage;
        }
        
        $categoryId = $request->get('categoryId');
        
        if($categoryId != null){
            $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(array('id' => $categoryId));
            $category = $category[0]->getId();
        } else {
             $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
             $buf = array();
             foreach($category as $c) {
                 $buf[] = $c->getId();
             }
             $category = $buf;
        }
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->join('s.category', 'c')
                ->where($query->expr()->in('c.id', $category))
                ->andWhere($query->expr()->eq('s.bases', 0))
                ->distinct()
                ->getQuery();
        $services = $query->getResult();
        
        $pageCount = count($services);
        if($pageCount != 0) {
                if($pageCount % $inPage == 0){
                        $pageCount = (int)($pageCount / $inPage);
                } else {
                        $pageCount = (int)($pageCount / $inPage + 1);
                }
        }
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->where($query->expr()->in('s.category', $category))
                ->andWhere($query->expr()->eq('s.bases', 0))
                ->distinct()
                ->setFirstResult($offset)
                ->setMaxResults($inPage)
                ->getQuery();
        $services = $query->getResult();
        
        return $this->render('default/services.html.twig', array(
                            'categories' => $categories,
                            'services' => $services,
                            'activeNav' => 2,
                            'pageCount' => $pageCount,
                            'activePage' => $pageId,
                            'categoryActive' => $categoryId,
        ));
    }
    /**
     * @Route("/tour{id}")
     */
    public function showTour($id)
    {
        $tour = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($id);
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->where($query->expr()->eq('s.base', $tour->getBase()->getId()))
                ->andWhere($query->expr()->isNull('s.sublegal'))
                ->distinct()
                ->getQuery();
        $basesServices = $query->getResult(); 
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->where($query->expr()->isNotNull('s.base'))
                ->andWhere($query->expr()->isNotNull('s.sublegal'))
                ->distinct()
                ->getQuery();
        $sublegalsServices = $query->getResult();
        
        return $this->render('default/tour.html.twig', array(
                            'tour' => $tour,
                            'basesServices' => $basesServices,
                            'sublegalsServices' => $sublegalsServices
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
