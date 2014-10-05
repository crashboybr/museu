<?php

namespace Museu\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Museu\BackendBundle\Entity\Exposition;
use Museu\BackendBundle\Entity\Newsletter;
use Museu\BackendBundle\Form\NewsletterType;

class DefaultController extends Controller
{
    public function indexAction()
    {
      
    	$em = $this->getDoctrine()->getManager();

        $banners = $em->getRepository('MuseuBackendBundle:Banner')->findAll();

        return $this->render('MuseuFrontendBundle:Default:index.html.twig', array('banners' => $banners));
    }

    public function picFooterAction()
    {
      
        $em = $this->getDoctrine()->getManager();

        $pics = $em->getRepository('MuseuBackendBundle:PicFooter')->findAll();

        return $this->render('MuseuFrontendBundle:Default:picfooter.html.twig', array('pics' => $pics));
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


    public function retrievePublishInfo() {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('MuseuBackendBundle:Book')->findAll();
        $teses = $em->getRepository('MuseuBackendBundle:Tese')->findAll();
        $ebooks = $em->getRepository('MuseuBackendBundle:eBook')->findAll();
        $videos = $em->getRepository('MuseuBackendBundle:VideoAcervo')->findAll();
        $musics = $em->getRepository('MuseuBackendBundle:Music')->findAll();

        $total_books = count($books);
        $total_ebooks = count($ebooks);
        $total_teses = count($teses);
        $total_videos = count($videos);
        $total_artigos = 0;
        $total_tccs = 0;

        $data['books'] = $books;
        $data['teses'] = $teses;
        $data['ebooks'] = $ebooks;
        $data['videos'] = $videos;
        $data['musics'] = $musics;
        $data['total_books'] = count($books);
        $data['total_teses'] = count($teses);
        $data['total_ebooks'] = count($ebooks);
        $data['total_musics'] = count($musics);
        $data['total_videos'] = count($videos);
        $data['total_artigos'] = 0;
        $data['total_tccs'] = 0;

        return $data;
    
    }

    public function publicationsAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:publications.html.twig',
         array(
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
        ));
    }

    public function booksAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:books.html.twig',
         array(
            'books' => $data['books'],
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
        ));
    }

    public function ebooksAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:ebooks.html.twig',
         array(
            'ebooks' => $data['ebooks'],
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
        ));

    }

    public function videosAcervoAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:videos.html.twig',
         array(
            'videos' => $data['videos'],
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
        ));

    }

    public function musicAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:music.html.twig',
         array(
            'musics' => $data['musics'],
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
        ));

    }


    public function tesesAction()
    {
        $data = $this->retrievePublishInfo();

        return $this->render('MuseuFrontendBundle:Publicacoes:teses.html.twig',
         array(
            'teses' => $data['teses'],
            'total_books' => $data['total_books'],
            'total_ebooks' => $data['total_ebooks'],
            'total_teses' => $data['total_teses'],
            'total_artigos' => $data['total_artigos'],
            'total_tccs' => $data['total_tccs'],
            'total_videos' => $data['total_videos'],
            'total_musics' => $data['total_musics'],
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

    public function tvAction()
    {    
        $em = $this->getDoctrine()->getManager();
        //$videos = $em->getRepository('MuseuBackendBundle:Video')->findBy(array('active' => true));
        $videos = $em->getRepository('MuseuBackendBundle:Video')->findAll();
        

        $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $videos,
            $this->get('request')->query->get('page', $page_number)/*page number*/,
            24
        );

        
   
        return $this->render('MuseuFrontendBundle:Default:tv.html.twig', array('videos' => $pagination));
    
    }

    public function radioAction()
    {    
        $em = $this->getDoctrine()->getManager();
        //$videos = $em->getRepository('MuseuBackendBundle:Video')->findBy(array('active' => true));
        $videos = $em->getRepository('MuseuBackendBundle:Video')->findAll();
        

        $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $videos,
            $this->get('request')->query->get('page', $page_number)/*page number*/,
            24
        );

        
   
        return $this->render('MuseuFrontendBundle:Default:radio.html.twig', array('videos' => $pagination));
    
    }

    public function cineAction()
    {    
        $em = $this->getDoctrine()->getManager();
        //$videos = $em->getRepository('MuseuBackendBundle:Video')->findBy(array('active' => true));
        $videos = $em->getRepository('MuseuBackendBundle:Video')->findAll();
        

        $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $videos,
            $this->get('request')->query->get('page', $page_number)/*page number*/,
            24
        );

        
   
        return $this->render('MuseuFrontendBundle:Default:cine.html.twig', array('videos' => $pagination));
    
    }

    public function universidadeAction()
    {    
   
        return $this->render('MuseuFrontendBundle:Default:universidade.html.twig');
    
    }

    public function bibliotecaAction()
    {    
   
        return $this->render('MuseuFrontendBundle:Default:biblioteca.html.twig');
    
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
        switch ($option) {
            case 'videos':
                $acervos = $em->getRepository('MuseuBackendBundle:Video')->findAll();
            default:
                $acervos = $em->getRepository('MuseuBackendBundle:Tese')->findAll();
        }
        
        return $this->render('MuseuFrontendBundle:Acervo:index.html.twig', array('acervos' => $acervos, 'option' => ucfirst($option)));
    }

    public function newsletterAction()
    {
        $request = $this->getRequest();
        if ($request->getMethod() == "POST") {
            //var_dump($request);exit;
        } else {

            $form = $this->createForm(new NewsletterType(), $entity, array(
                'action' => $this->generateUrl('banner_create'),
                'method' => 'POST',
            ));

            $form->add('submit', 'submit', array('label' => 'Create'));

        }
    }
    public function newsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $noticias = $em->getRepository('MuseuBackendBundle:Press')->findBy(array('type' => 'noticia'));
       
        return $this->render('MuseuFrontendBundle:Default:news.html.twig', array('noticias' => $noticias));
    }
}
