<?php

namespace Burger\Catalog\Domain\Model\Category;

use Burger\Shared\Domain\Exception\NotFoundException;

class CategoryNotFoundException extends NotFoundException
{
    public function __construct(string $message = 'Category not found')
    {
        parent::__construct($message);
    }
}