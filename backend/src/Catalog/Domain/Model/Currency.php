<?php

namespace Burger\Catalog\Domain\Model;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class Currency extends StringValueObject
{
    public function assert(string $value): void
    {
        if (!preg_match('/^[A-Z]{3}$/', $value)) {
            throw new InvalidArgumentException('Invalid currency `' . $value . '`');
        }
    }
}
