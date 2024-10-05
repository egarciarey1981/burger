<?php

namespace Burger\Catalog\Domain\Model\Currency;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;

class CurrencyFormat extends StringValueObject
{
    public function assert(string $value): void
    {
    }
}