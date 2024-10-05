<?php

namespace Burger\Catalog\Domain\Model\Currency;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;

class CurrencyId extends StringValueObject
{
    public function assert(string $value): void
    {
    }
}