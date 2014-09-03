<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\eBook;
use Museu\BackendBundle\Form\eBookType;

/**
 * eBook controller.
 *
 */
class eBookController extends Controller
{

    /**
     * Lists all eBook entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:eBook')->findAll();

        return $this->render('MuseuBackendBundle:eBook:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new eBook entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new eBook();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('livros_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:eBook:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a eBook entity.
    *
    * @param eBook $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(eBook $entity)
    {
        $form = $this->createForm(new eBookType(), $entity, array(
            'action' => $this->generateUrl('livros_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new eBook entity.
     *
     */
    public function newAction()
    {
        $entity = new eBook();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:eBook:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eBook entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:eBook')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find eBook entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:eBook:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing eBook entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:eBook')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find eBook entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:eBook:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a eBook entity.
    *
    * @param eBook $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(eBook $entity)
    {
        $form = $this->createForm(new eBookType(), $entity, array(
            'action' => $this->generateUrl('livros_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing eBook entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:eBook')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find eBook entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('livros_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:eBook:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a eBook entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:eBook')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find eBook entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('livros'));
    }

    /**
     * Creates a form to delete a eBook entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livros_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
