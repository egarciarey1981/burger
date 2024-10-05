<?php

namespace Burger\Catalog\Domain\Model\Category;

interface CategoryRepository
{
    public function all(): array;
    public function ofCategoryId(CategoryId $id): Category;
}