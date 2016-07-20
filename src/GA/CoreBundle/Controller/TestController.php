<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;


class TestController extends Controller
{
    public function test1Action()
		{
			return $this->forward('ga_core.test_controller:indexAction');
		}
    
		public function newAction()
}
