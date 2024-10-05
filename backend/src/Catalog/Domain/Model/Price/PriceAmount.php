<?php

namespace Burger\Catalog\Domain\Model\Price;

use Burger\Shared\Domain\Model\ValueObject\FloatValueObject;
use InvalidArgumentException;

class PriceAmount extends FloatValueObject
{
    public function assert(float $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price amount must be greater than or equal to zero');
        }
    }
}