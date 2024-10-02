<?php

namespace Burger\Catalog\Application\Service\Product;

class ViewProductResponse
{
    private array $product;

    public function __construct(array $product)
    {
        $this->product = $product;
    }

    public function product(): array
    {
        return $this->product;
    }
}