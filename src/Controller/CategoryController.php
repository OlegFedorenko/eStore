<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(Products $productsService)
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $productsService->getAllCategory(),
        ]);
    }

    /**
     * @Route("/categories/{id}", name="category_show", requirements={"id" = "\d+"})
     * @ParamConverter("category", options={"mapping"={"id"="id"}})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category, Products $productsService)
    {
        return $this->render('categories/show.html.twig',['categories'=> $category]);
    }
}
