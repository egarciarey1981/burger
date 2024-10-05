<?php

namespace Burger\Catalog\Domain\Model\Currency;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class CurrencyId extends StringValueObject
{
    public function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Currency id cannot be empty');
        }
    }
}