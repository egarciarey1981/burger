<?php

namespace Burger\Catalog\Application\Query\Product\List;

use Burger\Shared\Domain\Model\Bus\Query\Query;

class ListProductsQuery implements Query
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
