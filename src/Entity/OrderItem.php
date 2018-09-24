<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="order_items")
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default:0"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, options={"default:0"})
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, options={"default:0"})
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn(nullable=true)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="order")
     */
    private $product;

    public function __construct()
    {
        $this->quantity = 0;
        $this->price = 0;
        $this->cost = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function addQuantity(int $quantity)
    {
        $this->quantity += $quantity;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
