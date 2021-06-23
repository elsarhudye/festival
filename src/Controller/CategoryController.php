<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="app_category")
     */
    public function index(Request $request): Response
    {

        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
      
       
        if ($form->isSubmitted() && $form->isValid()) {
      
        $em = $this->getDoctrine()->getManager();
      
        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('app_home');

        }


        return $this->render('category/index.html.twig', [
            'controller_name' => 'creation de la liste des categories des artistes',
       'categoryForm'=>$form->createView()
        ]);
    }


    

}
