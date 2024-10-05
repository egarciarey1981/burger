<?php

namespace Burger\Catalog\Domain\Model\Image;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;

class ImageTitle extends StringValueObject
{
    protected function assert(mixed $value): void
    {
    }
}