<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\Category;
use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryImageUrl;
use Burger\Catalog\Domain\Model\Category\CategoryName;
use Burger\Catalog\Domain\Model\Category\CategoryNotFoundException;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;

class InMemoryCategoryRepository implements CategoryRepository
{
    private array $Categories = [];

    public function __construct(array $Categories = [])
    {
        if (empty($Categories)) {
            $this->initialize();
        } else {
            $this->Categories = $Categories;
        }
    }

    public function all(): array
    {
        return $this->Categories;
    }

    public function ofCategoryId(CategoryId $CategoryId): Category
    {
        foreach ($this->Categories as $Category) {
            if ($Category->id()->equals($CategoryId)) {
                return $Category;
            }
        }

        throw new CategoryNotFoundException('Category of id `' . $CategoryId->value() . '` not found');
    }

    private function initialize(): void
    {
        $data = [
            ['burgers', 'Burgers', ''],
            ['starters', 'Starters', ''],
            ['drinks', 'Drinks', ''],
        ];

        foreach ($data as $item) {
            $this->Categories[] = new Category(
                new CategoryId($item[0]),
                new CategoryName($item[1]),
                new CategoryImageUrl($item[2]),
            );
        }
    }
}