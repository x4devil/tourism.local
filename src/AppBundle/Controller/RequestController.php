<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\UserRequest;
use AppBundle\Form\RequestType;

/**
 * Request controller.
 *
 * @Route("/request")
 */
class RequestController extends Controller
{

    /**
     * Lists all Request entities.
     *
     * @Route("/", name="request")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:UserRequest')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Request entity.
     *
     * @Route("/", name="request_create")
     * @Method("POST")
     * @Template("AppBundle:UserRequest:new.html.twig")
     */
    public function createAction(UserRequest $request)
    {
        $entity = new UserRequest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('request_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Request entity.
     *
     * @param Request $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserRequest $entity)
    {
        $form = $this->createForm(new RequestType(), $entity, array(
            'action' => $this->generateUrl('request_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Request entity.
     *
     * @Route("/new", name="request_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserRequest();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Request entity.
     *
     * @Route("/{id}", name="request_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:UserRequest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Request entity.
     *
     * @Route("/{id}/edit", name="request_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:UserRequest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Request entity.
    *
    * @param Request $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Request $entity)
    {
        $form = $this->createForm(new RequestType(), $entity, array(
            'action' => $this->generateUrl('request_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Request entity.
     *
     * @Route("/{id}", name="request_update")
     * @Method("PUT")
     * @Template("AppBundle:UserRequest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:UserRequest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('request_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Request entity.
     *
     * @Route("/{id}", name="request_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:UserRequest')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Request entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('request'));
    }

    /**
     * Creates a form to delete a Request entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('request_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
