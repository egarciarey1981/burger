<?php

namespace Burger\Catalog\Application\Service\Product;

class ListProductResponse
{
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function products(): array
    {
        return $this->products;
    }
}