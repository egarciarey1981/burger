<?php

namespace Burger\Order\Application\Service\Order;

class CreateOrderResponse
{
    private array $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }

    public function order(): array
    {
        return $this->order;
    }
}
