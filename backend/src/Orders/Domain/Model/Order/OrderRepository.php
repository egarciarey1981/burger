<?php

namespace Burger\Orders\Domain\Model\Order;

interface OrderRepository
{
    public function nextIdentity(): OrderId;
    public function save(Order $order): void;
}