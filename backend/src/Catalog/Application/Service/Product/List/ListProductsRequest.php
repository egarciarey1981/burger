<?php

namespace Burger\Catalog\Application\Service\Product\List;

class ListProductsRequest
{
    private string $currency;

    public function __construct(string $currency)
    {
        $this->currency = $currency;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
