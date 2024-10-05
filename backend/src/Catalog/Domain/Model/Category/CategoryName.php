<?php

namespace Burger\Catalog\Domain\Model\Category;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class CategoryName extends StringValueObject
{
    public function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Category name cannot be empty');
        }
    }
}