<?php

namespace Burger\Orders\Domain\Model\Order;

use Burger\Shared\Domain\Model\ValueObject\IntValueObject;

class OrderLineQuantity extends IntValueObject
{
    protected function assert(int $value): void
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('The quantity must be greater than 0');
        }
    }
}