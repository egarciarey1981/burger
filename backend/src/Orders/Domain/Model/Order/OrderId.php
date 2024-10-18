<?php

namespace Burger\Orders\Domain\Model\Order;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class OrderId extends StringValueObject
{
    public function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Order id cannot be empty');
        }
    }
}
