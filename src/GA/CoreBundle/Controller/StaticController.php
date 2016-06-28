<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
    public function indexAction()
    {
        return $this->render('GACoreBundle:Static:index.html.twig');
    }
}
