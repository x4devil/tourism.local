<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Sublegal;
use AppBundle\Form\SublegalType;

/**
 * Sublegal controller.
 *
 * @Route("/sublegal")
 */
class SublegalController extends Controller
{

    /**
     * Lists all Sublegal entities.
     *
     * @Route("/", name="sublegal")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Sublegal')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sublegal entity.
     *
     * @Route("/", name="sublegal_create")
     * @Method("POST")
     * @Template("AppBundle:Sublegal:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sublegal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sublegal_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sublegal entity.
     *
     * @param Sublegal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sublegal $entity)
    {
        $form = $this->createForm(new SublegalType(), $entity, array(
            'action' => $this->generateUrl('sublegal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sublegal entity.
     *
     * @Route("/new", name="sublegal_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sublegal();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sublegal entity.
     *
     * @Route("/{id}", name="sublegal_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sublegal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sublegal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sublegal entity.
     *
     * @Route("/{id}/edit", name="sublegal_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sublegal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sublegal entity.');
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
    * Creates a form to edit a Sublegal entity.
    *
    * @param Sublegal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sublegal $entity)
    {
        $form = $this->createForm(new SublegalType(), $entity, array(
            'action' => $this->generateUrl('sublegal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sublegal entity.
     *
     * @Route("/{id}", name="sublegal_update")
     * @Method("PUT")
     * @Template("AppBundle:Sublegal:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sublegal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sublegal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sublegal_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sublegal entity.
     *
     * @Route("/{id}", name="sublegal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Sublegal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sublegal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sublegal'));
    }

    /**
     * Creates a form to delete a Sublegal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sublegal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
