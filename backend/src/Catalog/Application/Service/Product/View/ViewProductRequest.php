<?php

namespace Burger\Catalog\Application\Service\Product\View;

class ViewProductRequest
{
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function productId(): string
    {
        return $this->productId;
    }
}
