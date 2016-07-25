<?php

namespace GA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use GA\CoreBundle\Entity\Product;
use GA\CoreBundle\Form\ProductType;

class ProductController extends Controller
{
   public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                         
						$em = $this->getDoctrine()->getManager();
						$em->persist($product);
						$em->flush();

            return $this->redirect($this->generateUrl('ga_core_admin'));
        }

        return $this->render('GACoreBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
		
		public function viewAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();

			$product = $em
					->getRepository('GACoreBundle:Product')
					->find($id);
					
			if ($product === null){
				throw new NotFoundHttpException("le tournoi d'id".$id."n\'existe pas.");
			}
						
			return $this->render('GACoreBundle:Product:view.html.twig', array(
				'id' => $id,
				'product' => $product,
				));
						
		}
		
		public function deleteAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$product = $em
					->getRepository('GACoreBundle:Product')
					->find($id);
					
			if ($product === null){
				throw new NotFoundHttpException("le product d'id".$id."n\'existe pas.");
			}			
				
			$form = $this->get('form.factory')->create();
    
			if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($product);						
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
				
			return $this->redirect($this->generateUrl('ga_core_admin'));
			}
			
			return $this->render('GACoreBundle:product:delete.html.twig', array(
      'product' => $product,
      'form'   => $form->createView(),
			));
			
		}
}
