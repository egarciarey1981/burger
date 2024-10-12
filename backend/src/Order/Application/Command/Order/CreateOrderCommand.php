<?php

namespace Backend\Order\Application\Command\Order;

use Backend\Shared\Domain\Model\Bus\Command\Command;
use DateTimeImmutable;

class CreateOrderCommand implements Command
{
    private DateTimeImmutable $date;
    private array $lines;

    public function __construct(DateTimeImmutable $date, array $lines)
    {
        $this->date = $date;
        $this->lines = $lines;
    }
    
    public function date(): DateTimeImmutable
    {
        return $this->date;
    }

    public function lines(): array
    {
        return $this->lines;
    }
}