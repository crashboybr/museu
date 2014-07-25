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

    public function publicationsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('MuseuBackendBundle:Book')->findAll();
        $teses = $em->getRepository('MuseuBackendBundle:Tese')->findAll();
        $total_books = count($books);
        $total_ebooks = 0;
        $total_teses = count($teses);
        $total_artigos = 0;
        $total_tccs = 0;

        return $this->render('MuseuFrontendBundle:Publicacoes:publications.html.twig',
         array(
            'total_books' => $total_books,
            'total_ebooks' => $total_ebooks,
            'total_teses' => $total_teses,
            'total_artigos' => $total_artigos,
            'total_tccs' => $total_tccs,
        ));
    }

    public function booksAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('MuseuBackendBundle:Book')->findAll();
        $teses = $em->getRepository('MuseuBackendBundle:Tese')->findAll();

        $total_books = count($books);
        $total_ebooks = 0;
        $total_teses = count($teses);
        $total_artigos = 0;
        $total_tccs = 0;

        return $this->render('MuseuFrontendBundle:Publicacoes:books.html.twig',
         array(
            'books' => $books,
            'total_books' => $total_books,
            'total_ebooks' => $total_ebooks,
            'total_teses' => $total_teses,
            'total_artigos' => $total_artigos,
            'total_tccs' => $total_tccs,
        ));

        return $this->render('MuseuFrontendBundle:Publicacoes:books.html.twig', array('books' => $books));
    }

    public function tesesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teses = $em->getRepository('MuseuBackendBundle:Tese')->findAll();
        $books = $em->getRepository('MuseuBackendBundle:Book')->findAll();

        $total_teses = count($teses);
        $total_ebooks = 0;
        $total_books = count($books);
        $total_artigos = 0;
        $total_tccs = 0;

        return $this->render('MuseuFrontendBundle:Publicacoes:teses.html.twig',
         array(
            'teses' => $teses,
            'total_books' => $total_books,
            'total_ebooks' => $total_ebooks,
            'total_teses' => $total_teses,
            'total_artigos' => $total_artigos,
            'total_tccs' => $total_tccs,
        ));

        
    }

    public function viewExpositionAction(Exposition $exposition)
    {    
        $em = $this->getDoctrine()->getManager();

        $expositions = $em->getRepository('MuseuBackendBundle:Exposition')->findAll();
   
        return $this->render('MuseuFrontendBundle:Default:view_exposition.html.twig', array('exposition' => $exposition, 'expositions' => $expositions));
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

    public function acessibilidadeAction()
    {    
        return $this->render('MuseuFrontendBundle:Default:acessibilidade.html.twig');
    }

    public function educacaoAction()
    {    
        return $this->render('MuseuFrontendBundle:Default:educacao.html.twig');
    }

    public function contactAction()
    {    
        return $this->render('MuseuFrontendBundle:Default:contact.html.twig');
    }

    public function guaribaAction($option)
    {    

        $em = $this->getDoctrine()->getManager();
        if ($option != 'timeline' && $option != 'mapa' && $option != 'depoimento') 
        {
            $statements = $em->getRepository('MuseuBackendBundle:Statement')->findBy(array('type' => $option));

            if ($option == 'patroes') $option = 'patrões';

            return $this->render('MuseuFrontendBundle:Guariba:statements.html.twig', array('statements' => $statements, 'option' => ucfirst($option)));
        }
        else {
            if ($option == 'timeline') {

                $timelines = $em->getRepository('MuseuBackendBundle:Timeline')->findBy(array(), array('year' => 'ASC', 'month' => 'ASC'));


                
                //echo "<pre>";
                //\Doctrine\Common\Util\Debug::dump($timelines);exit;
                foreach ($timelines as $tm) {
                    
                    $tms[$tm->getYear()][$tm->getMonth()][$tm->getId()]['desc'] = $tm->getDescription();
                    $tms[$tm->getYear()][$tm->getMonth()][$tm->getId()]['title'] = $tm->getTitle();
                    $tms[$tm->getYear()][$tm->getMonth()][$tm->getId()]['pic'] = $tm->getPic(); 
                    
                }
                
                //\Doctrine\Common\Util\Debug::dump($tms['1950']['1']);
                //exit;

                /*foreach ($tms as $year => $tm) {
                    var_dump($tm, $year);
                }
                exit;
                */
                return $this->render('MuseuFrontendBundle:Guariba:' . $option . '.html.twig', 
                                    array('option' => $option, 'timelines' => $tms));
            }
            return $this->render('MuseuFrontendBundle:Guariba:' . $option . '.html.twig');    
        }

        
    }

    public function acervoAction($option)
    {    
        $em = $this->getDoctrine()->getManager();
        if ($option == 'teses') 
        {
            $acervos = $em->getRepository('MuseuBackendBundle:Tese')->findAll();
        }
        else {
            $acervos = array();
        }
        return $this->render('MuseuFrontendBundle:Acervo:index.html.twig', array('acervos' => $acervos, 'option' => ucfirst($option)));
    }


}
