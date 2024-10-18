<?php

namespace Burger\Orders\Domain\Model\Order;

class Order
{
    private OrderId $id;
    private OrderDate $date;
    private array $orderLines;

    public function __construct(
        OrderId $id,
        OrderDate $date,
        array $orderLines
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->orderLines = $orderLines;
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function date(): OrderDate
    {
        return $this->date;
    }

    public function orderLines(): array
    {
        return $this->orderLines;
    }
}
