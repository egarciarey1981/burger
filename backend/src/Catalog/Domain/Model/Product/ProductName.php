<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class ProductName extends StringValueObject
{
    protected function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Product name is required');
        }
    }
}