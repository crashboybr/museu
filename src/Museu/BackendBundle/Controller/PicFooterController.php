<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\PicFooter;
use Museu\BackendBundle\Form\PicFooterType;

/**
 * PicFooter controller.
 *
 */
class PicFooterController extends Controller
{

    /**
     * Lists all PicFooter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:PicFooter')->findAll();

        return $this->render('MuseuBackendBundle:PicFooter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PicFooter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PicFooter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('picfooter_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:PicFooter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PicFooter entity.
     *
     * @param PicFooter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PicFooter $entity)
    {
        $form = $this->createForm(new PicFooterType(), $entity, array(
            'action' => $this->generateUrl('picfooter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PicFooter entity.
     *
     */
    public function newAction()
    {
        $entity = new PicFooter();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:PicFooter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PicFooter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:PicFooter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PicFooter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:PicFooter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PicFooter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:PicFooter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PicFooter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:PicFooter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PicFooter entity.
    *
    * @param PicFooter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PicFooter $entity)
    {
        $form = $this->createForm(new PicFooterType(), $entity, array(
            'action' => $this->generateUrl('picfooter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PicFooter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:PicFooter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PicFooter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('picfooter_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:PicFooter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PicFooter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:PicFooter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PicFooter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('picfooter'));
    }

    /**
     * Creates a form to delete a PicFooter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('picfooter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
