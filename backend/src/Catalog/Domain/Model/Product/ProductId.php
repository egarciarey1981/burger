<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class ProductId extends StringValueObject
{
    protected function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Product id cannot be empty');
        }
    }
}