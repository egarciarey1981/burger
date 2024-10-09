<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Shared\Domain\Model\Bus\Query\Query;

class ViewProductQuery implements Query
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
