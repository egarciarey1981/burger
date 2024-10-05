<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class ProductDescription extends StringValueObject
{
    protected function assert(string $value): void
    {
    }
}