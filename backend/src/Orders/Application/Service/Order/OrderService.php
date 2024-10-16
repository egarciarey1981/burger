<?php

namespace Burger\Order\Application\Service\Order;

use Burger\Orders\Domain\Model\Order\OrderRepository;

class OrderService
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
}