<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{
    public function indexAction()
    {
        return $this->render('GACoreBundle:Annonce:index.html.twig');
    }
}
