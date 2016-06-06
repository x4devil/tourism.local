<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tour;
use AppBundle\Entity\Pictures;
use AppBundle\Form\TourType;

/**
 * Tour controller.
 *
 * @Route("/tour")
 */
class TourController extends Controller {

    protected $activePage = 'tour';

    /**
     * Lists all Tour entities.
     *
     * @Route("/", name="tour")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tour')->findAll();

        return array(
            'entities' => $entities,
            'activePage' => $this->activePage,
        );
    }

    /**
     * Creates a new Tour entity.
     *
     * @Route("/", name="tour_create")
     * @Method("POST")
     * @Template("AppBundle:Tour:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Tour();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tour_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'activePage' => $this->activePage,
        );
    }

    /**
     * Creates a form to create a Tour entity.
     *
     * @param Tour $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tour $entity) {
        $form = $this->createForm(new TourType(), $entity, array(
            'action' => $this->generateUrl('tour_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Добавить'));

        return $form;
    }

    /**
     * Displays a form to create a new Tour entity.
     *
     * @Route("/new", name="tour_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Tour();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'activePage' => $this->activePage,
        );
    }

    /**
     * Finds and displays a Tour entity.
     *
     * @Route("/{id}", name="tour_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tour entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            'activePage' => $this->activePage,
        );
    }

    /**
     * Displays a form to edit an existing Tour entity.
     *
     * @Route("/{id}/edit", name="tour_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tour entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        $uploadForm = $this->createUploadForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'upload_form' => $uploadForm->createView(),
            'activePage' => $this->activePage,
        );
    }

    /**
     * Creates a form to edit a Tour entity.
     *
     * @param Tour $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Tour $entity) {
        $form = $this->createForm(new TourType(), $entity, array(
            'action' => $this->generateUrl('tour_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * Edits an existing Tour entity.
     *
     * @Route("/{id}", name="tour_update")
     * @Method("PUT")
     * @Template("AppBundle:Tour:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tour entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tour_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'activePage' => $this->activePage,
        );
    }

    /**
     * Deletes a Tour entity.
     *
     * @Route("/{id}", name="tour_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tour')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tour entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tour'));
    }

    /**
     *
     * @Route("/{id}/upload", name="picture_upload")
     * @Method("PUT")
     * @Template("AppBundle:Tour:edit.html.twig")
     */
    public function uploadAction(Request $request, $id) {
        $files = $request->files;
        if ($files != NULL) {
            $em = $this->getDoctrine()->getManager();
            $tour = $em->getRepository('AppBundle:Tour')->find($id);
            
            $path = __DIR__ . '../../../../web/img/';

            foreach ($files as $file => $val) {
                foreach ($val as $v) {
                    //md5("текущее время"_"id тура").jpg
                    $now = \DateTime::createFromFormat('U.u', microtime(true));
                    $name = '/web/img/'.md5($now->format('Y-m-d H:i:s.u').'_'.$id).'.jpg';
                    $v->move($path, $name);
                    
                    $picture = new Pictures();
                    $picture->setTour($tour);
                    $picture->setFile($name);
                    $em->persist($picture);
                    $em->flush();
                }
            }
        }
        return $this->redirect($this->generateUrl('tour_edit', array('id' => $id)).'#pictures');
    }
    
    /**
     *
     * @Route("/{id}/upload", name="picture_delete")
     * @Method("DELETE")
     */
    public function unloadAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $picture = $em->getRepository('AppBundle:Pictures')->find($id);
        if (!$picture) {
            return $this->redirect($this->generateUrl('tour'));
        }
        
        $tourId = $picture->getTour()->getId();

        $em->remove($picture);
        $em->flush();

        return $this->redirect($this->generateUrl('tour_edit', array('id' => $tourId)).'#pictures');
    }

    /**
     * Creates a form to delete a Tour entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('tour_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Удалить'))
                        ->getForm()
        ;
    }

    /**
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUploadForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('picture_upload', array('id' => $id)))
                        ->setMethod('PUT')
                        ->add('files', 'file', array(
                            'label' => 'Файлы',
                            'attr' => array(
                                'required' => 'true',
                                'multiple' => 'multiple',
                                'name' => 'images[]',)))
                        ->add('submit', 'submit', array('label' => 'Загрузить', 'attr' => array('class' => 'btn')))
                        ->getForm()
        ;
    }

}
