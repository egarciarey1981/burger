<?php

namespace Burger\Catalog\Domain\Model\Product;

class Product
{
    private ProductId $id;
    private ProductName $name;
    private ProductCategory $category;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ProductCategory $category,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
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

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'category' => (string) $this->category,
        ];
    }
}
