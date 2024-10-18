<?php

namespace Burger\Catalog\Application\Query\Product\View;

use Burger\Shared\Domain\Model\Bus\Query\Query;

class ViewProductQuery implements Query
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
