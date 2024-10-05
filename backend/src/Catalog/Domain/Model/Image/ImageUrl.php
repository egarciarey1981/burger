<?php

namespace Burger\Catalog\Domain\Model\Image;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;

class ImageUrl extends StringValueObject
{
    protected function assert(string $value): void
    {
    }
}