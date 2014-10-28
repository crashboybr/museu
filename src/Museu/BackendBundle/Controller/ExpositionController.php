<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Exposition;
use Museu\BackendBundle\Entity\ExpositionImage;
use Museu\BackendBundle\Entity\ExpositionAuthor;
use Museu\BackendBundle\Form\ExpositionType;

/**
 * Exposition controller.
 *
 */
class ExpositionController extends Controller
{

    /**
     * Lists all Exposition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MuseuBackendBundle:Exposition')->findAll();

        return $this->render('MuseuBackendBundle:Exposition:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Exposition entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Exposition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $files = $request->files->get('museu_backendbundle_exposition');
            //var_dump($entity);exit;
            $em = $this->getDoctrine()->getManager();

            foreach ($entity->getExpositionImages() as $expositionImage)
            {
                //var_dump($image);
                $expositionImage->setExpositions($entity);
                
                $file = $expositionImage->getPic();
                //var_dump($file);exit;
                $expositionImage->setPic(null);
                $expositionImage->setFile($file);
            }

            foreach ($entity->getExpositionAuthors() as $expositionAuthor)
            {
                $expositionAuthor->setExpositions($entity);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('exposicoes_show', array('id' => $entity->getId())));
        }

        return $this->render('MuseuBackendBundle:Exposition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Exposition entity.
    *
    * @param Exposition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Exposition $entity)
    {
        $exposition_image = new ExpositionImage();
        $entity->getExpositionImages()->add($exposition_image);

        $exposition_author = new ExpositionAuthor();
        
        $entity->addExpositionAuthor($exposition_author);

        $form = $this->createForm(new ExpositionType(), $entity, array(
            'action' => $this->generateUrl('exposicoes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Exposition entity.
     *
     */
    public function newAction()
    {
        $entity = new Exposition();
        $form   = $this->createCreateForm($entity);

        return $this->render('MuseuBackendBundle:Exposition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exposition entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Exposition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exposition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Exposition:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Exposition entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Exposition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exposition entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MuseuBackendBundle:Exposition:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Exposition entity.
    *
    * @param Exposition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Exposition $entity)
    {
        
        $form = $this->createForm(new ExpositionType(), $entity, array(
            'action' => $this->generateUrl('exposicoes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Exposition entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MuseuBackendBundle:Exposition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exposition entity.');
        }
        echo "<pre>";
        $files = $request->files->get('museu_backendbundle_exposition');
        
        foreach ($files['exposition_images'] as $key => $file) {
            
            if (!is_object($file['pic'])) 
                unset($files['exposition_images'][$key]);
            
        }
        
        $request->files->set('museu_backendbundle_exposition', $files);
        $files = $files['exposition_images'];
        $req = $request->get('museu_backendbundle_exposition');
        $req['exposition_images'] = $files;
        

        $request->request->set('museu_backendbundle_exposition', $req);

        
        

        $entity->setUpdatedAt(new \DateTime());
        $i = 0;
        foreach ($entity->getExpositionImages() as $expositionImage) {
            $pics[$expositionImage->getId()]['pic'] = $expositionImage->getPic();
            $pics[$expositionImage->getId()]['author'] = $_POST['museu_backendbundle_exposition']['exposition_images'][$i]['title'];
            $pics[$expositionImage->getId()]['title'] = $_POST['museu_backendbundle_exposition']['exposition_images'][$i]['author'];
            //$pics[$expositionImage->getId()]['title'] = $expositionImage->getTitle();
            $i++;
        }
        //var_dump($pics);exit;
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            //var_dump($entity->getExpositionImages());exit;
            //echo "<pre>";
            //\Doctrine\Common\Util\Debug::dump($request);
            //echo "<pre>";
            //var_dump($_FILES);exit;
            foreach ($entity->getExpositionImages() as $expositionImage)
            {
                
                $file = $expositionImage->getPic();
                
                $expositionImage->setAuthor($pics[$expositionImage->getId()]['author']);
                $expositionImage->setTitle($pics[$expositionImage->getId()]['title']);
                if ($file) { 
                    //var_dump($expositionImage->getId());
                    //var_dump($file);
                    //var_dump($expositionImage->getId());
                    //$expositionImage->setExpositions($entity);
                    //$expositionImage->setPic(null);
                    $expositionImage->setFile($file);
                    $expositionImage->setUpdatedAt(new \DateTime());
                    
                    
                } else {
                    
                    $expositionImage->setPic($pics[$expositionImage->getId()]['pic']);
                }
                //var_dump($pics[$expositionImage->getId()]['title']);
                $em->persist($expositionImage);
                $em->flush();
                
            }
            //exit;
            //var_dump($em->getSql());exit;
            //$em->flush();
            //exit;
            //$em->persist($expositionImage);
            //exit;
            foreach ($entity->getExpositionAuthors() as $expositionAuthor)
            {
                $expositionAuthor->setExpositions($entity);
            }

            $em->persist($entity);
            $em->flush();
            //exit;
            return $this->redirect($this->generateUrl('exposicoes_edit', array('id' => $id)));
        }

        return $this->render('MuseuBackendBundle:Exposition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Exposition entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MuseuBackendBundle:Exposition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Exposition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('exposicoes'));
    }

    /**
     * Creates a form to delete a Exposition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exposicoes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
