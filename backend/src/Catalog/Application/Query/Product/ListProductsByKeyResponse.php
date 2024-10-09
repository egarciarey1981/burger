<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;

class ListProductsByKeyResponse implements QueryResponse
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
