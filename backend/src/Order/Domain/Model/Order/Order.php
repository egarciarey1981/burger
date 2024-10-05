<?php

namespace Burger\Order\Domain\Model\Order;

class Order
{
    private OrderId $id;
    private OrderDate $date;

    public function __construct(
        OrderId $id,
        OrderDate $date,
    ) {
        $this->id = $id;
        $this->date = $date;
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function date(): OrderDate
    {
        return $this->date;
    }
}
