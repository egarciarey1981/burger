<?php

namespace Burger\Orders\Infrastructure\Persistence\InMemory;

use Burger\Orders\Domain\Model\Order\Order;
use Burger\Orders\Domain\Model\Order\OrderId;
use Burger\Orders\Domain\Model\Order\OrderRepository;

class InMemoryOrderRepository implements OrderRepository
{
    private array $orders = [];

    public function nextIdentity(): OrderId
    {
        return new OrderId(uniqid());
    }

    public function save(Order $order): void
    {
        $this->orders[] = $order;
    }
}
