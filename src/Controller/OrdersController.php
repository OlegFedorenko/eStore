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

        if ($request->isXmlHttpRequest())
        {
            return $this->cartInHeader($orders);
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("orders/cart-in-header", name="orders_cart_in_header")
     */
    public function cartInHeader(Orders $orders)
    {
        $cart = $orders->getCartFromSession();

        return $this->render('orders/cart_in_header.html.twig', ['cart' => $cart]);
    }

    /**
     * @Route("orders/cart", name="orders_cart")
     */
    public function cart(Orders $orders)
    {
        $cart = $orders->getCartFromSession();
        $items = $orders->getCartFromSession()->getItems();

        return $this->render('orders/cart.html.twig',
            ['cart' => $cart,
                'items' => $items]);
    }
}