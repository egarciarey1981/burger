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
    private Category $category;
    private Price $price;
    private ?Image $image;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ?ProductDescription $description,
        Category $category,
        Price $price,
        ?Image $image,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
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

    public function category(): Category
    {
        return $this->category;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'description' => is_null($this->description) ? null : (string) $this->description,
            'category' => $this->category->toArray(),
            'price' => $this->price->toArray(),
            'image' => $this->image?->toArray() ?? null,
        ];
    }
}
