<?php

namespace Burger\Order\Infrastructure\Persistence\InMemory;

use Burger\Order\Domain\Model\Order\Order;
use Burger\Order\Domain\Model\Order\OrderId;
use Burger\Order\Domain\Model\Order\OrderRepository;

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