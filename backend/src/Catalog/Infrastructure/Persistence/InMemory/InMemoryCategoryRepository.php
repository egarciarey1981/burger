<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\Category;
use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryName;
use Burger\Catalog\Domain\Model\Category\CategoryNotFoundException;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Image\ImageId;
use Burger\Catalog\Domain\Model\Image\ImageNotFoundException;
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

    public function ofCategoryId(CategoryId $CategoryId): Category
    {
        foreach ($this->Categories as $Category) {
            if ($Category->id()->equals($CategoryId)) {
                return $Category;
            }
        }

        return null;
    }

    private function initialize(): void
    {
        $data = [
            ['burgers', 'Burgers', 'burgers.png', 'burgers'],
            ['starters', 'Starters', 'starters.png', 'starters'],
            ['drinks', 'Drinks', 'drinks.png', 'drinks'],
        ];

        foreach ($data as $item) {
            try {
                $image = $this->imageRepository->ofImageId(new ImageId($item[3]));
            } catch (ImageNotFoundException $e) {
                $image = null;
            }

            $this->Categories[] = new Category(
                new CategoryId($item[0]),
                new CategoryName($item[1]),
                $image,
            );
        }
    }
}
