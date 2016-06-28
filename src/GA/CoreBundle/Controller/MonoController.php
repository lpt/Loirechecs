<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MonoController extends Controller
{
    public function indexAction()
    {
        return $this->render('GACoreBundle:Mono:index.html.twig');
    }
}
