<?php

namespace Burger\Catalog\Application\Query\Product\ListGroupedByKey;

use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;

class ListProductsGroupedByKeyResponse implements QueryResponse
{
    private array $productsGroupedByKey;

    public function __construct(array $productsGroupedByKey)
    {
        $this->productsGroupedByKey = $productsGroupedByKey;
    }

    public function productsGroupedByKey(): array
    {
        return $this->productsGroupedByKey;
    }
}
