<?php

namespace Burger\Catalog\Domain\Model\Category;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;

class CategoryName extends StringValueObject
{
    public function assert(string $value): void
    {
    }
}