<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MultiController extends Controller
{
    public function indexAction()
    {
        return $this->render('GACoreBundle:Multi:index.html.twig');
    }
}
