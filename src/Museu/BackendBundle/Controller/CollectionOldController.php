<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Museu\BackendBundle\Entity\Collection;
use Museu\BackendBundle\Entity\Video;
use Museu\BackendBundle\Form\CollectionType;
use Museu\BackendBundle\Form\CollectionExcelType;

/**
 * Collection controller.
 *
 */
class CollectionOldController extends Controller
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

    public function newExcelAction()
    {
        $entity = new Collection();
        $form = $this->createForm(new CollectionExcelType(), null, array(
            'action' => $this->generateUrl('acervo_create_excel'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $this->render('MuseuBackendBundle:Collection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    public function createExcelAction(Request $request)
    {
        $entity = new Collection();
        
        $form = $this->createForm(new CollectionExcelType(), null, array(
            'action' => $this->generateUrl('acervo_create_excel'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        $filename = date('YmdHis') . "_" . $_FILES["museu_backendbundle_collection_excel"]["name"]["file"];
        move_uploaded_file($_FILES["museu_backendbundle_collection_excel"]["tmp_name"]["file"], "upload/acervo/" . $filename);

        //$form->handleRequest($request);
        $xl_obj=$this->get('phpexcel');
        $file = "upload/acervo/" . $filename;
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        
        $em = $this->getDoctrine()->getManager();
        /*
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                
                
                 echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

                 foreach ($worksheet->getRowIterator() as $row) {
                     echo '    Row number - ' , $row->getRowIndex() , EOL;
                     
                         $cellIterator = $row->getCellIterator();
                         $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                         $i = 1;
                         if ($row->getRowIndex() > 1) {
                            //$collection = new Collection()
                            $video = new Video();
                             foreach ($cellIterator as $cell) {
                                 if (!is_null($cell)) {
                                    
                                    if ($i == 2) $video->setChannel($cell->getCalculatedValue());
                                    if ($i == 4) $video->setTitle($cell->getCalculatedValue());
                                    if ($i == 5) $video->setUrl($cell->getCalculatedValue());
                              
                                     
                                    
                                 }

                                 $i++;
                             }
                             
                             $em->persist($video);
                             $em->flush();
                        }
                    
                 }
             
         }
*/
         /*

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                if ($worksheet->getTitle() == "Acervos") { 
                 echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

                 foreach ($worksheet->getRowIterator() as $row) {
                     echo '    Row number - ' , $row->getRowIndex() , EOL;
                     
                         $cellIterator = $row->getCellIterator();
                         $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                         if ($row->getRowIndex() > 1) {
                            $collection = new Collection();
                             foreach ($cellIterator as $cell) {
                                 if (!is_null($cell)) {
                                    

                              
                                     echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
                                 }
                             }
                        }
                    
                 }
             }
         }*/
        exit;
        return $this->render('MuseuBackendBundle:Collection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('acervo_show', array('id' => $entity->getId())));
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
            'action' => $this->generateUrl('acervo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

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
            'delete_form' => $deleteForm->createView(),        ));
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
            'edit_form'   => $editForm->createView(),
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
            'action' => $this->generateUrl('acervo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

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

            return $this->redirect($this->generateUrl('acervo_edit', array('id' => $id)));
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

        return $this->redirect($this->generateUrl('acervo'));
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
            ->setAction($this->generateUrl('acervo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
