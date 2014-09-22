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

        if ($option != 'musicas-videos') {
            $order = null;
            
            $qb = $em->createQueryBuilder();
            $qb->select('f')
            ->from('MuseuBackendBundle:Collection', 'f');
            //->where('f.category = :category');

            $filters['category'] = $option;
            
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

            $qb->andWhere('f.category = :category');
            $acervos = $qb->getQuery()->getResult();

            //var_dump($acervos);exit;
            //$acervos = $em->getRepository("MuseuBackendBundle:Collection")->findBy(
            //    array('category' => $option),
            //    $order
            //    );
        } else {
            $musics = $em->getRepository("MuseuBackendBundle:Music")->findAll();
            $videos = $em->getRepository("MuseuBackendBundle:VideoAcervo")->findAll();    
            $acervos = array_merge($musics, $videos);
        }
        switch ($option) {
            case 'jornal':
                $title = 'Jornais';
                break;
            case 'revista':
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
            case 'artigo':
                $title = 'Artigos Acadêmicos';
                break;
            case 'tese':
                $title = 'Teses & TCCs';
                break;
            case 'musicas-videos':
                $title = 'Músicas & Vídeos';
                break;
            case 'filmes':
                $title = 'Filmes & Documentários';
                break;
            case 'especiais':
                $title = 'Especiais de TV';
                break;
            case 'outros':
                $title = 'Outros';
                break;
        }

        $total['jornais'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Jornal')));
        $total['revistas'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Revista')));
        $total['tvs'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'TV')));
        $total['radios'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Radio')));
        $total['sites'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Site')));
        $total['fotografias'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Fotografia')));
        $total['ilustracoes'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Ilustraçao')));
        $total['artigos'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Artigo')));
        $total['teses'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Tese')));
        $total['filmes'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Filmes')));
        $total['especiais'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Especiais')));
        $total['outros'] = count($em->getRepository("MuseuBackendBundle:Collection")->findBy(array('category' => 'Outros')));

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

        $acervo = $em->getRepository("MuseuBackendBundle:Collection")->find($id);

        $acervo->setTotalVisit($acervo->getTotalVisit() + 1);
        $em->persist($acervo);
        $em->flush();

        return $this->render('MuseuFrontendBundle:Acervo:view.html.twig', 
            array('acervo' => $acervo));

    }


    
}
