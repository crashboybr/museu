<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Collection;
use Museu\BackendBundle\Form\CollectionType;

/**
 * Collection controller.
 *
 */
class CollectionController extends Controller
{

    /**
     * Lists all Collection entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:Collection')->findAll();

        return $this->render('MuseuBackendBundle:Collection:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Collection entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Collection();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (!$entity->getAcervoId()) $entity->setAcervoId(-500);
            $em->persist($entity);
            $em->flush();
            if ($entity->getAcervoId() == -500) {
                $entity->setAcervoId($entity->getId());
                $em->persist($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('collection_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:Collection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Collection entity.
     *
     * @param Collection $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Collection $entity)
    {
        $form = $this->createForm(new CollectionType(), $entity, array(
            'action' => $this->generateUrl('collection_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Criar'));

        return $form;
    }

    /**
     * Displays a form to create a new Collection entity.
     *
     */
    public function newAction()
    {
        $entity = new Collection();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:Collection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Collection entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Collection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Collection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Collection:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Collection entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Collection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Collection entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Collection:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Collection entity.
    *
    * @param Collection $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Collection $entity)
    {
        $form = $this->createForm(new CollectionType(), $entity, array(
            'action' => $this->generateUrl('collection_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Atualizar'));

        return $form;
    }
    /**
     * Edits an existing Collection entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Collection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Collection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('collection'));
        }

        return $this->render('MuseuBackendBundle:Collection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Collection entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:Collection')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Collection entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('collection'));
    }

    /**
     * Creates a form to delete a Collection entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('collection_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Apagar'))
            ->getForm()
        ;
    }


    public function sendFileAction(Request $request)
    {
        if ($request->getMethod() == "POST") {
            //echo "<pre>";
            //var_dump($_FILES['files']);exit;
            foreach ($_FILES['files']['tmp_name'] as $key => $file) {
                move_uploaded_file($file, "images/acervo/" . $_FILES['files']['name'][$key]);
            }
            $this->get('session')->getFlashBag()->add(
                        'success',
                        'Arquivos enviado com sucesso!');

        }
        return $this->render('MuseuBackendBundle:Collection:sendfile.html.twig');
    }
}
