<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Shared\Domain\Model\Exception\NotFoundException;

class ProductNotFoundException extends NotFoundException
{
    public function __construct(string $message = 'Product not found')
    {
        parent::__construct($message);
    }
}