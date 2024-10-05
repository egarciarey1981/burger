<?php

namespace Burger\Catalog\Domain\Model\Price;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class PriceCurrency extends StringValueObject
{
    public function assert(string $value): void
    {
        if (!preg_match('/^[A-Z]{3}$/', $value)) {
            throw new InvalidArgumentException('Invalid currency `' . $value . '`');
        }
    }
}