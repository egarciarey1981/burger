<?php

namespace Burger\Order\Application\Service\Order;

use DateTimeImmutable;

class CreateOrderRequest
{
    private DateTimeImmutable $date;
    private array $orderLines;

    public function __construct(
        DateTimeImmutable $date,
        array $orderLines
    ) {
        $this->date = $date;
        $this->orderLines = $orderLines;
    }

    public function date(): DateTimeImmutable
    {
        return $this->date;
    }

    public function orderLines(): array
    {
        return $this->orderLines;
    }
}
