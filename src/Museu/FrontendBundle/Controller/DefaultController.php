<?php

namespace Museu\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $banners = $em->getRepository('MuseuBackendBundle:Banner')->findAll();

        return $this->render('MuseuFrontendBundle:Default:index.html.twig', array('banners' => $banners));
    }
}
