<?php

namespace Burger\Catalog\Domain\Model\Image;

use Burger\Shared\Domain\Model\Exception\NotFoundException;

class ImageNotFoundException extends NotFoundException
{
    public function __construct(string $message = 'Image not found')
    {
        parent::__construct($message);
    }
}