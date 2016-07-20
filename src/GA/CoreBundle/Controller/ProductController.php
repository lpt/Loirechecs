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
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $product->getBrochure();

            // Generate a unique name for the file before saving it
          //  $fileName = md5(uniqid()).'.'.$file->guessExtension();
					  $fileName = $this->get('ga_core.brochure_uploader')->upload($file);

            // Move the file to the directory where brochures are stored
            //$file->move(
             //   $this->getParameter('brochures_directory'),
               // $fileName
            //);

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $product->setBrochure($fileName);

            // ... persist the $product variable or any other work
						$em = $this->getDoctrine()->getManager();
						$em->persist($product);
						$em->flush();

            return $this->redirect($this->generateUrl('ga_core_admin'));
        }

        return $this->render('GACoreBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
		
		public function viewAction()
		{
			
			
			return $this->redirect($this->generateUrl('ga_core_admin'));
		}
}
