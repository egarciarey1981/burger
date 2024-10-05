<?php

namespace Burger\Catalog\Domain\Model\Category;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class CategoryImageUrl extends StringValueObject
{
    public function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Category image url cannot be empty');
        }
    }
}