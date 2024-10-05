<?php

namespace Burger\Order\Application\Service\Order;

use DateTimeImmutable;

class CreateOrderRequest
{
    private DateTimeImmutable $date;

    public function __construct(
        DateTimeImmutable $date,
    ) {
        $this->date = $date;
    }

    public function date(): DateTimeImmutable
    {
        return $this->date;
    }
}
