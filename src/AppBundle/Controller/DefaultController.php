<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\UserRequest;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:News');
        $query = $repository->createQueryBuilder('n');
        $query = $query
                ->distinct()
                ->orderBy('n.id', 'DESC')
                ->setMaxResults(2)
                ->getQuery();
        $news = $query->getResult();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->distinct()
                ->where($query->expr()->eq('s.bases', 0))
                ->orderBy('s.id', 'DESC')
                ->setMaxResults(4)
                ->getQuery();
        $services = $query->getResult();

//        return $this->render('default/index.html.twig', array(
//                    'categories' => $categories,
//                    'news' => $news,
//                    'services' => $services
//        ));
        return $this->redirect('/news/page1');
    }

    /**
     * @Route("/tours/page{pageId}")
     * Method("GET")
     * @Template()
     */
    public function toursAction($pageId, Request $request) {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        $inPage = 5;
        if ($pageId == 1) {
            $offset = 0;
        } else {
            $offset = ($pageId - 1) * $inPage;
        }

        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $categoryId = $request->get('categoryId');

        if ($categoryId != null) {
            $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(array('id' => $categoryId));
        }

        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findBy(array('category' => $category));

        $pageCount = count($tours);
        if ($pageCount != 0) {
            if ($pageCount % $inPage == 0) {
                $pageCount = (int) ($pageCount / $inPage);
            } else {
                $pageCount = (int) ($pageCount / $inPage + 1);
            }
        }

        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findBy(
                array('category' => $category), array(), $inPage, $offset);

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
    public function servicesAction($pageId, Request $request) {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        $inPage = 5;
        if ($pageId == 1) {
            $offset = 0;
        } else {
            $offset = ($pageId - 1) * $inPage;
        }

        $categoryId = $request->get('categoryId');

        if ($categoryId != null) {
            $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(array('id' => $categoryId));
            $category = $category[0]->getId();
        } else {
            $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
            $buf = array();
            foreach ($category as $c) {
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
                ->andWhere($query->expr()->isNotNull('s.sublegal'))
                ->distinct()
                ->getQuery();
        $services = $query->getResult();

        $pageCount = count($services);
        if ($pageCount != 0) {
            if ($pageCount % $inPage == 0) {
                $pageCount = (int) ($pageCount / $inPage);
            } else {
                $pageCount = (int) ($pageCount / $inPage + 1);
            }
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Service');
        $query = $repository->createQueryBuilder('s');
        $query = $query
                ->where($query->expr()->in('s.category', $category))
                ->andWhere($query->expr()->eq('s.bases', 0))
                ->andWhere($query->expr()->isNotNull('s.sublegal'))
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
     * @Route("/services/page{pageId}/{serviceId}")
     * Method("PUT")
     * @Template()
     */
    public function addService($pageId, $serviceId, Request $request) {
        $service = $this->getDoctrine()->getRepository('AppBundle:Service')->find($serviceId);
        $session = $this->getRequest()->getSession();
        $sessionServices = $session->get('services');
        if (!$sessionServices) {
            $sessionServices = array();
        }
        $sessionServices[] = $service;
        $session->set('services', $sessionServices);

        return $this->redirect('/services/page' . $pageId);
    }

    /**
     * @Route("/tour{id}", name="user_tour_show")
     * @Method("GET")
     */
    public function showTour($id) {
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
                ->andWhere($query->expr()->eq('s.bases', 1))
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
     * @Route("/tour{id}", name="user_tour_add")
     * @Method("PUT")
     */
    public function addTour(Request $request, $id) {
        $tour = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($id);

        $session = $this->getRequest()->getSession();
        $sessionServices = $session->get('services');
        if (!$sessionServices) {
            $sessionServices = array();
        }
        $sessionTour = $session->get('tours');
        if (!$sessionTour) {
            $sessionTour = array();
        }

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

        $bServices = array();
        foreach ($basesServices as $service) {
            $tmp = $request->get('base-service-' . $service->getId());
            if ($tmp == 'on') {
                $sessionServices[] = $service;
            }
        }

        $sServices = array();
        foreach ($basesServices as $service) {
            $tmp = $request->get('sublegal-service-' . $service->getId());
            if ($tmp == 'on') {
                $sessionServices[] = $service;
            }
        }
        $sessionTour[] = $tour;

        $session->set('tours', $sessionTour);
        $session->set('services', $sessionServices);

        return $this->redirect($this->generateUrl('user_tour_show', array('id' => $id)));
    }

    /**
     * @Route("/cart", name="show_cart")
     * @Method("GET")
     */
    public function showCart() {
        $session = $this->getRequest()->getSession();
        $data = array();
        $data['tours'] = $session->get('tours');
        $data['services'] = $session->get('services');

        return $this->render('default/cart.html.twig', $data);
    }

    /**
     * @Route("/cart/service/{id}", name="delete_service_cart")
     * @Method("DELETE")
     */
    public function deleteServiceCart($id) {
        $session = $this->getRequest()->getSession();
        $sessionServices = $session->get('services');
        if ($sessionServices) {
            $buf = array();
            foreach ($sessionServices as $s) {
                if ($s->getId() != $id) {
                    $buf[] = $s;
                }
            }

            $session->set('services', $buf);
        }
        return $this->redirect($this->generateUrl('show_cart'));
    }

    /**
     * @Route("/cart/tours/{id}", name="delete_tour_cart")
     * @Method("DELETE")
     */
    public function deleteTourCart($id) {
        $session = $this->getRequest()->getSession();
        $sessionTours = $session->get('tours');
        if ($sessionTours) {
            $buf = array();
            foreach ($sessionTours as $s) {
                if ($s->getId() != $id) {
                    $buf[] = $s;
                }
            }

            $session->set('tours', $buf);
        }
        return $this->redirect($this->generateUrl('show_cart'));
    }

    /**
     * @Route("/confirm", name="confirm_request")
     * @Method("PUT")
     */
    public function requestConf(Request $req) {
        $user = $this->get('security.context')->getToken()->getUser();

        $request = new UserRequest();
        $request->setPay(true);
        $request->setUser($user);

        $session = $this->getRequest()->getSession();
        $sessionTours = $session->get('tours');
        $sessionServices = $session->get('services');

        $tours = new \Doctrine\Common\Collections\ArrayCollection();
        $services = new \Doctrine\Common\Collections\ArrayCollection();
        
        if ($sessionTours) {
            foreach ($sessionTours as $t) {
                if (!$tours->contains($t)) {
                    $tours->add($t);
                }
            }
        }

        if ($sessionServices) {
            foreach ($sessionServices as $t) {
                if (!$services->contains($t)) {
                    $services->add($t);
                }
            }
        }
        
        if ($services->count() <= 0 && $tours->count() <= 0) {
            return $this->redirect($this->generateUrl('show_cart'));
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($request);
        $em->flush();
        
        if ($services->count() > 0) {
            foreach($services as $s) {
                $sql = 'insert into userrequest_service(userrequest_id, service_id) values(:idreq, :idserv)';
                $params = array('idreq' => $request->getId(), 'idserv' => $s->getId());
                
                $query = $em->getConnection()->prepare($sql);
                $query->execute($params);
                $request->addService($s);
            }
        }

        if ($tours->count() > 0) {
            foreach($tours as $t) {
                $sql = 'insert into userrequest_tour(userrequest_id, tour_id) values(:idreq, :idtour)';
                $params = array('idreq' => $request->getId(), 'idtour' => $t->getId());
                
                $query = $em->getConnection()->prepare($sql);
                $query->execute($params);
                $request->addTour($t);
            }
        }
        
        $session->set('services', array());
        $session->set('tours', array());

        return $this->redirect($this->generateUrl('show_cart'));
    }

    /**
     * @Route("/news/page{pageId}")
     */
    public function showNews($pageId) {
        $news = $this->getDoctrine()->getRepository('AppBundle:News')->findAll();

        $inPage = 5;
        if ($pageId == 1) {
            $offset = 0;
        } else {
            $offset = ($pageId - 1) * $inPage;
        }

        $pageCount = count($news);

        if ($pageCount != 0) {
            if ($pageCount % $inPage == 0) {
                $pageCount = (int) ($pageCount / $inPage);
            } else {
                $pageCount = (int) ($pageCount / $inPage + 1);
            }
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:News');
        $query = $repository->createQueryBuilder('n');
        $query = $query
                ->distinct()
                ->orderBy('n.id', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($inPage)
                ->getQuery();
        $news = $query->getResult();

        return $this->render('default/news.html.twig', array(
                    'activeNav' => 1,
                    'news' => $news,
                    'pageCount' => $pageCount,
                    'activePage' => $pageId
        ));
    }

}
