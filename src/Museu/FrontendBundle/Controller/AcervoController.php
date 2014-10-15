<?php

namespace Museu\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Museu\BackendBundle\Entity\Exposition;
use Museu\BackendBundle\Entity\CountCollection;

class AcervoController extends Controller
{
    

    public function indexAction($option)
    {    
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        //if ($option != 'musicas-videos') {
            $order = null;
            
            $qb = $em->createQueryBuilder();
            $qb->select('f')
            ->from('MuseuBackendBundle:Collection', 'f');
            //->where('f.category = :category');
            
            if ($option != '') $filters['category'] = $option;
            
            $date_from = $request->get("date_from");
            $date_to   = $request->get("date_to");
            $filtro    = $request->get("filtro");
            $query     = $request->get("q");

            
            if ($filtro) { 
                if ($filtro == 'recentes') 
                    $qb->orderBy('f.acervo_date', 'desc');
                elseif ($filtro == 'acessados') 
                    $qb->orderBy('f.total_visit', 'desc');
            } 
            
            if ($query) {
                $q = "%" . $query . "%";

                $filters['q'] = $q;
                $qb->orWhere('f.title like :q'); 
                $qb->orWhere('f.author like :q');
                $qb->orWhere('f.vehicle like :q');
                $qb->orWhere('f.keyword like :q');   
            }

            if ($date_from) {

                $qb->andWhere('f.acervo_date >= :date_from');
                $filters['date_from'] = $date_from;

            }
            if ($date_to) {
                $qb->andWhere('f.acervo_date <= :date_to');
                $filters['date_to'] = $date_to;
            }
            //var_dump($filters);exit;

            $qb->setParameters($filters);
            //var_dump($qb->getQuery()->getSql());exit;

            if ($option != '') $qb->andWhere('f.category = :category');
            $acervos = $qb->getQuery()->getResult();

            //var_dump($acervos);exit;
            //$acervos = $em->getRepository("MuseuBackendBundle:Collection")->findBy(
            //    array('category' => $option),
            //    $order
            //    );
        //} else {
        //    $musics = $em->getRepository("MuseuBackendBundle:Music")->findAll();
        //    $videos = $em->getRepository("MuseuBackendBundle:VideoAcervo")->findAll();    
        //    $acervos = array_merge($musics, $videos);
        //}
        switch ($option) {
            case 'jornais':
                $title = 'Jornais';
                break;
            case 'revistas':
                $title = 'Revistas';
                break;
            case 'tv':
                $title = 'TVs';
                break;
            case 'radio':
                $title = 'Rádios';
                break;
            case 'site':
                $title = 'Sites';
                break;
            case 'fotografia':
                $title = 'Fotografias';
                break;
            case 'ilustracao':
                $title = 'Ilustrações';
                break;
            case 'artigosacademicos':
                $title = 'Artigos Acadêmicos';
                break;
            case 'teses':
                $title = 'Teses';
                break;
            case 'tccs':
                $title = 'TCCs';
                break;
            case 'musicas':
                $title = 'Músicas';
                break;
            case 'filmes':
                $title = 'Filmes';
                break;
            case 'documentarios':
                $title = 'Documentários';
                break;
            case 'especiais':
                $title = 'Especiais de TV';
                break;
            case 'outros':
                $title = 'Outros';
                break;
            case 'videos':
                $title = 'Vídeos';
                break;
            case 'depoimentos':
                $title = 'Depoimentos';
                break;
            default:
                $title = 'Acervos Digitais';
                break;
        }

        $total['jornais'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'jornais')));
        $total['revistas'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'revistas')));
        $total['tvs'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'tv')));
        $total['radios'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'radio')));
        $total['sites'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'site')));
        $total['fotografias'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'fotografia')));
        $total['ilustracoes'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'ilustraçao')));
        $total['artigos'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Artigo')));
        $total['teses'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Teses')));
        $total['tccs'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'TCCs')));
        $total['filmes'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Filmes')));
        $total['documentarios'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'documentarios')));
        $total['especiais'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Especiais')));
        $total['outros'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Outros')));
        $total['videos'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Videos')));
        $total['livros'] = count($em->getRepository("MuseuBackendBundle:Book")->findAll());
        $total['depoimentos'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'depoimentos')));
        
        $total['musicas'] = count($em->getRepository("MuseuBackendBundle:Music")->findAll()) + count($em->getRepository("MuseuBackendBundle:VideoAcervo")->findAll());

        $mostrar = isset($_GET['mostrar']) ? $_GET['mostrar'] : 20;
        if ($mostrar != 'all') { 
            $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $acervos,
                $this->get('request')->query->get('page', $page_number)/*page number*/,
                $mostrar
            );
        } else {
            $pagination = $acervos;
        }
        
        return $this->render('MuseuFrontendBundle:Acervo:acervos.html.twig', 
            array('acervos' => $pagination, 
                'option' => $option, 
                'title' => $title, 
                'total' => $total, 
                'total_result' => count($acervos),
                'query' => $query,
                'date_from' => $date_from,
                'date_to' => $date_to,
                'filtro' => $filtro,
                'mostrar' => $mostrar
                ));
    }

    public function viewAction($id)
    { 
        $em = $this->getDoctrine()->getManager();

        $acervo = $em->getRepository("MuseuBackendBundle:Collection")->findOneBy(array('acervo_id' => $id));

        $acervo->setTotalVisit($acervo->getTotalVisit() + 1);
        $em->persist($acervo);
        $em->flush();

        $related = $acervo->getRelated();
        $related = explode(';', $related);
        $relateds = null;
        if ($related[0] != null) {
            foreach ($related as $related_id) {
                $relateds[] = $em->getRepository("MuseuBackendBundle:Collection")->findOneBy(array('acervo_id' => $related_id));            
            }
        }

        $pics = $acervo->getPic();
        $pics = explode(';', $pics);
        

        return $this->render('MuseuFrontendBundle:Acervo:view.html.twig', 
            array('acervo' => $acervo, 'relateds' => $relateds, 'pics' => $pics));

    }


    
}
