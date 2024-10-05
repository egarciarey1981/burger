<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Catalog\Domain\Model\Price\Price;

class Product
{
    private ProductId $id;
    private ProductName $name;
    private ProductCategory $category;
    private Price $price;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ProductCategory $category,
        Price $price,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function category(): ProductCategory
    {
        return $this->category;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'category' => (string) $this->category,
            'price' => $this->price->toArray(),
        ];
    }
}
