<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\Category;
use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryName;
use Burger\Catalog\Domain\Model\Category\CategoryNotFoundException;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Image\ImageId;
use Burger\Catalog\Domain\Model\Image\ImageRepository;

class InMemoryCategoryRepository implements CategoryRepository
{
    private ImageRepository $imageRepository;
    private array $Categories = [];

    public function __construct(
        ImageRepository $imageRepository,
        array $Categories = [],
    ) {
        $this->imageRepository = $imageRepository;

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

    public function ofCategoryId(CategoryId $id, bool $throwException = false): ?Category
    {
        foreach ($this->Categories as $Category) {
            if ($Category->id()->equals($id)) {
                return $Category;
            }
        }

        if ($throwException) {
            throw new CategoryNotFoundException('Category of id ' . $id->value() . ' not found');
        } else {
            return null;
        }
    }

    private function initialize(): void
    {
        $data = [
            [
                'id' => 'burgers',
                'name' => 'Burgers',
                'image' => 'burgers',
            ],
            [
                'id' => 'drinks',
                'name' => 'Drinks',
                'image' => 'drinks',
            ],
            [
                'id' => 'starters',
                'name' => 'Starters',
                'image' => 'starters',
            ],
        ];

        foreach ($data as $item) {
            $this->Categories[] = new Category(
                new CategoryId($item['id']),
                new CategoryName($item['name']),
                $this->imageRepository->ofImageId(new ImageId($item['image']))
            );
        }
    }
}
