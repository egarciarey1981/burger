<?php

namespace Burger\Order\Application\Service\Order;

use Burger\Order\Domain\Model\Order\Order;
use Burger\Order\Domain\Model\Order\OrderDate;
use DateTimeImmutable;

class CreateOrderService extends OrderService
{
    public function execute(CreateOrderRequest $createOrderRequest): void
    {
        $order = new Order(
            $this->orderRepository->nextIdentity(),
            new OrderDate(new DateTimeImmutable()),
        );

        $this->orderRepository->save($order);
    }
}