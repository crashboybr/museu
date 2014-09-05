<?php

namespace Museu\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Museu\BackendBundle\Entity\Exposition;

class AcervoController extends Controller
{
    

    public function indexAction($option)
    {    
        $em = $this->getDoctrine()->getManager();
        if ($option == 'videos') $repo = 'VideoAcervo';
        elseif ($option == 'musicas') $repo = 'Music';
        else $repo = 'Collection';

        if ($repo == 'Collection') {
            if ($option == 'jornais') $category = 'jornal';
            elseif ($option == 'revistas') $category = 'jornal';
            $acervos = $em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => $option));
        } else {
            $acervos = $em->getRepository("MuseuBackendBundle:{$repo}")->findAll();    
        }
        

        $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $acervos,
            $this->get('request')->query->get('page', $page_number)/*page number*/,
            20
        );
        
        return $this->render('MuseuFrontendBundle:Acervo:acervos.html.twig', 
            array('acervos' => $pagination, 'option' => $option));
    }


    
}
