<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Press;
use Museu\BackendBundle\Form\PressType;

/**
 * Press controller.
 *
 */
class PressController extends Controller
{

    /**
     * Lists all Press entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:Press')->findAll();

        return $this->render('MuseuBackendBundle:Press:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Press entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Press();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('imprensa_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:Press:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Press entity.
    *
    * @param Press $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Press $entity)
    {
        $form = $this->createForm(new PressType(), $entity, array(
            'action' => $this->generateUrl('imprensa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Press entity.
     *
     */
    public function newAction()
    {
        $entity = new Press();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:Press:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Press entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Press')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Press entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Press:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Press entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Press')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Press entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Press:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Press entity.
    *
    * @param Press $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Press $entity)
    {
        $form = $this->createForm(new PressType(), $entity, array(
            'action' => $this->generateUrl('imprensa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Press entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Press')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Press entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('imprensa_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:Press:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Press entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:Press')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Press entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('imprensa'));
    }

    /**
     * Creates a form to delete a Press entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imprensa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
