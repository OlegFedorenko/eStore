<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders", name="orders")
     */
    public function index()
    {
        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @param Orders $orders
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     *
     * @Route("/orders/add-to-cart/{id}/{quantity}", name="orders_add_to_cart")
     */
    public function addToCart(Product $product, Orders $orders, Request $request, $quantity = 1)
    {
        $orders->addToCart($product, $quantity);

        return $this->redirect($request->headers->get('referer'));
    }
}
