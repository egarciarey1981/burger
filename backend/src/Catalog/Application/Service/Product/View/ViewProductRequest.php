<?php

namespace Burger\Catalog\Application\Service\Product\View;

class ViewProductRequest
{
    private string $productId;
    private string $currency;

    public function __construct(string $productId, string $currency)
    {
        $this->productId = $productId;
        $this->currency = $currency;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
