<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Newsletter;
use Museu\BackendBundle\Form\NewsletterType;

/**
 * Newsletter controller.
 *
 */
class NewsletterController extends Controller
{

    /**
     * Lists all Newsletter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:Newsletter')->findAll();

        return $this->render('MuseuBackendBundle:Newsletter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Newsletter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Newsletter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:Newsletter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createFrontAction(Request $request)
    {
        $entity = new Newsletter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                        'success',
                        'Pronto! Agora você vai receber informações sobre as atividades do Museu do Trabalhador do Campo.');

            return $this->redirect($this->generateUrl('museu_frontend_homepage'));
        }
        
        $this->get('session')->getFlashBag()->add(
                        'error',
                        'E-mail inválido!');

        return $this->redirect($this->generateUrl('museu_frontend_homepage'));
    }

    /**
     * Creates a form to create a Newsletter entity.
     *
     * @param Newsletter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Newsletter $entity)
    {
        $form = $this->createForm(new NewsletterType(), $entity, array(
            'action' => $this->generateUrl('newsletter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    private function createCreateFormFront(Newsletter $entity)
    {
        $form = $this->createForm(new NewsletterType(), $entity, array(
            'action' => $this->generateUrl('newsletter_create_front'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'INSCREVER'));

        return $form;
    }

    /**
     * Displays a form to create a new Newsletter entity.
     *
     */
    public function newAction()
    {
        $entity = new Newsletter();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:Newsletter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newFrontAction()
    {
        $entity = new Newsletter();
        $form   = $this->createCreateFormFront($entity);

        return $this->render('MuseuBackendBundle:Newsletter:new_front.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Newsletter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Newsletter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Newsletter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Newsletter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Newsletter entity.
    *
    * @param Newsletter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Newsletter $entity)
    {
        $form = $this->createForm(new NewsletterType(), $entity, array(
            'action' => $this->generateUrl('newsletter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Newsletter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:Newsletter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Newsletter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:Newsletter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Newsletter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsletter'));
    }

    /**
     * Creates a form to delete a Newsletter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newsletter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
