<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;

class ViewProductResponse implements QueryResponse
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
