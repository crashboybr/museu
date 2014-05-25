<?php

namespace Museu\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Museu\BackendBundle\Entity\Exposition;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $banners = $em->getRepository('MuseuBackendBundle:Banner')->findAll();

        return $this->render('MuseuFrontendBundle:Default:index.html.twig', array('banners' => $banners));
    }


    public function expositionAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $expositions = $em->getRepository('MuseuBackendBundle:Exposition')->findAll();

        return $this->render('MuseuFrontendBundle:Default:exposition.html.twig', array('expositions' => $expositions));
    }

    public function pressAction()
    {    
        $em = $this->getDoctrine()->getManager();

        $noticias = $em->getRepository('MuseuBackendBundle:Press')->findBy(array('type' => 'noticia'));

        $releases = $em->getRepository('MuseuBackendBundle:Press')->findBy(array('type' => 'release'));

        $artigos  = $em->getRepository('MuseuBackendBundle:Press')->findBy(array('type' => 'artigo'));

        return $this->render('MuseuFrontendBundle:Default:imprensa.html.twig', array('noticias' => $noticias, 'releases' => $releases, 'artigos' => $artigos));
    }

    public function booksAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('MuseuBackendBundle:Book')->findAll();

        return $this->render('MuseuFrontendBundle:Default:books.html.twig', array('books' => $books));
    }

    public function viewExpositionAction(Exposition $exposition)
    {    
        return $this->render('MuseuFrontendBundle:Default:view_exposition.html.twig', array('exposition' => $exposition));
    }

    public function oqueAction()
    {    
        return $this->render('MuseuFrontendBundle:OMuseu:oque.html.twig');
    }

    public function missaoAction()
    {    
        return $this->render('MuseuFrontendBundle:OMuseu:missao.html.twig');
    }

    public function equipeAction()
    {    
        return $this->render('MuseuFrontendBundle:OMuseu:equipe.html.twig');
    }

    public function localizacaoAction()
    {    
        return $this->render('MuseuFrontendBundle:OMuseu:localizacao.html.twig');
    }

    public function educacaoAction()
    {    
        return $this->render('MuseuFrontendBundle:Default:educacao.html.twig');
    }
}
