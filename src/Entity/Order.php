<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order
{
    const STATUS_NEW=1;
    const STATUS_ORDERED=2;
    const STATUS_SENT=3;
    const STATUS_RECEIVED=4;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer", options={"default:1"})
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", options={"default:false"})
     */
    private $isPaid;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, options={"default:0"})
     */
    private $amount;

    /**
     * @var OrderItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="order",
     *     indexBy="product_id", cascade={"persist"})
     */
    private $items;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->status = self::STATUS_NEW;
        $this->isPaid = false;
        $this->amount = 0;
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrder($this);
            $this->calculateAmount();
        }

        return $this;
    }

    public function removeItem(OrderItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $this->calculateAmount();

            // set the owning side to null (unless already changed)
            if ($item->getOrder() === $this) {
                $item->setOrder(null);
            }
        }

        return $this;
    }

    public function calculateAmount()
    {
        $this->amount = 0;

        foreach ($this->items as $item)
        {
            $this->amount += $item->getCost();
        }
    }
}
