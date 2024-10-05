<?php

namespace Burger\Catalog\Application\Service\Category;

class ListCategoriesWithProductsResponse
{
    private array $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function categories(): array
    {
        return $this->categories;
    }
}