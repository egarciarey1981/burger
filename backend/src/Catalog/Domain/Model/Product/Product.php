<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Catalog\Domain\Model\Category\Category;
use Burger\Catalog\Domain\Model\Image\Image;
use Burger\Catalog\Domain\Model\Price\Price;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductName;

class Product
{
    private ProductId $id;
    private ProductName $name;
    private ?ProductDescription $description;
    private ?Image $image;
    private Category $category;
    private Price $price;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ?ProductDescription $description,
        ?Image $image,
        Category $category,
        Price $price
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
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

    public function description(): ?ProductDescription
    {
        return $this->description;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function category(): Category
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
            'description' => (string) $this->description ?? null,
            'image' => $this->image?->toArray() ?? null,
            'category' => $this->category->toArray(),
            'price' => $this->price->toArray(),
        ];
    }
}