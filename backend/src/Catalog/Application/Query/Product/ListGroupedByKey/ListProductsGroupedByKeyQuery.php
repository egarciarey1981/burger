<?php

namespace Burger\Catalog\Application\Query\Product\ListGroupedByKey;

use Burger\Shared\Domain\Model\Bus\Query\Query;

class ListProductsGroupedByKeyQuery implements Query
{
    private string $key;
    private string $currency;

    public function __construct(string $key, string $currency)
    {
        $this->key = $key;
        $this->currency = $currency;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
