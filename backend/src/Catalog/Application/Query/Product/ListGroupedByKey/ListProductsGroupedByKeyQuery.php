<?php

namespace Burger\Catalog\Application\Query\Product\ListGroupedByKey;

use Burger\Shared\Domain\Model\Bus\Query\Query;

class ListProductsGroupedByKeyQuery implements Query
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function key(): string
    {
        return $this->key;
    }
}
