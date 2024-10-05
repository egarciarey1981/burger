<?php

namespace Burger\Catalog\Domain\Model\Currency;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class CurrencyFormat extends StringValueObject
{
    public function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Currency format cannot be empty');
        }
    }
}