<?php

namespace Burger\Catalog\Domain\Model\Image;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class ImageTitle extends StringValueObject
{
    protected function assert(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Image title cannot be empty');
        }
    }
}