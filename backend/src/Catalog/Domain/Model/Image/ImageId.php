<?php

namespace Burger\Catalog\Domain\Model\Image;

use Burger\Shared\Domain\Model\ValueObject\StringValueObject;
use InvalidArgumentException;

class ImageId extends StringValueObject
{
    protected function assert(mixed $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('ImageId is required');
        }
    }
}