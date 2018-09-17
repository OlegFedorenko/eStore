<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"default": ""})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, options={"default": 0})
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isTop;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="product")
     */
    private $order;

    public function __construct()
    {
        $this->name = '';
        $this->price = 0;
        $this->isTop = false;
        $this->order = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getIsTop(): ?bool
    {
        return $this->isTop;
    }

    public function setIsTop(bool $isTop): self
    {
        $this->isTop = $isTop;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrder(): Collection
    {
        return $this->order;
    }

    public function addOrderr(OrderItem $orderr): self
    {
        if (!$this->order->contains($orderr)) {
            $this->order[] = $orderr;
            $orderr->setProduct($this);
        }

        return $this;
    }

    public function removeOrderr(OrderItem $orderr): self
    {
        if ($this->order->contains($orderr)) {
            $this->order->removeElement($orderr);
            // set the owning side to null (unless already changed)
            if ($orderr->getProduct() === $this) {
                $orderr->setProduct(null);
            }
        }

        return $this;
    }
}
