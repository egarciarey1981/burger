<?php

namespace Burger\Order\Domain\Model\Order;

use Burger\Catalog\Domain\Model\Product\Product;

class OrderLine
{
    private Product $product;
    private OrderLineQuantity $quantity;

    public function __construct(
        Product $product,
        OrderLineQuantity $quantity
    ) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): OrderLineQuantity
    {
        return $this->quantity;
    }
}
