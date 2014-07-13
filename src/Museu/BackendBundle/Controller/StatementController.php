<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Statement;
use Museu\BackendBundle\Form\StatementType;

/**
 * Statement controller.
 *
 */
class StatementController extends Controller
{

    /**
     * Lists all Statement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:Statement')->findAll();

        return $this->render('MuseuBackendBundle:Statement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Statement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Statement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statement_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:Statement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Statement entity.
     *
     * @param Statement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Statement $entity)
    {
        $form = $this->createForm(new StatementType(), $entity, array(
            'action' => $this->generateUrl('statement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Statement entity.
     *
     */
    public function newAction()
    {
        $entity = new Statement();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:Statement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Statement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Statement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Statement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Statement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Statement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Statement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Statement entity.
    *
    * @param Statement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Statement $entity)
    {
        $form = $this->createForm(new StatementType(), $entity, array(
            'action' => $this->generateUrl('statement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Statement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Statement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('statement_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:Statement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Statement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:Statement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Statement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('statement'));
    }

    /**
     * Creates a form to delete a Statement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
