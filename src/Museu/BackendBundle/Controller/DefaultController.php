<?php

namespace Museu\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MuseuBackendBundle:Default:index.html.twig');
    }
}
