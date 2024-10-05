<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Product\Product;
use Burger\Catalog\Domain\Model\Product\ProductDescription;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductImageUrl;
use Burger\Catalog\Domain\Model\Product\ProductName;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;
use Burger\Catalog\Domain\Model\Product\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    private array $products = [];
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        array $products = [],
    ) {
        $this->categoryRepository = $categoryRepository;

        if (empty($products)) {
            $this->initialize();
        } else {
            $this->products = $products;
        }
    }

    public function all(): array
    {
        return $this->products;
    }

    public function ofProductId(ProductId $productId): Product
    {
        foreach ($this->products as $product) {
            if ($product->id()->equals($productId)) {
                return $product;
            }
        }

        throw new ProductNotFoundException('Product of id `' . $productId->value() . '` not found');
    }

    private function initialize(): void
    {
        $data = [
            [
                'burger',
                'Burger',
                'Classic burger with beef, lettuce, tomato, onion, pickles, ketchup, and mustard',
                'burger.png',
                'burgers',
            ],
            [
                'cheeseburger',
                'Cheeseburger',
                'Classic burger with extra cheddar cheese',
                'cheeseburger.png',
                'burgers',
            ],
            [
                'chiken-burger',
                'Chiken Burger',
                'Crunchy chicken burger with lettuce, tomato, and mayonnaise',
                'chiken-burger.png',
                'burgers',
            ],
            [
                'fries',
                'Fries',
                '',
                'fried.png',
                'starters',
            ],
            [
                'onion-rings',
                'Onion Rings',
                '',
                'onion-rings.png',
                'starters',
            ],
            [
                'beer',
                'Beer',
                '',
                'beer.png',
                'drinks',
            ],
            [
                'soft-drink',
                'Soft Drink',
                '',
                'soft-drink.png',
                'drinks',
            ],
            [
                'water',
                'Water',
                '',
                'water.png',
                'drinks',
            ],
        ];

        foreach ($data as $item) {
            $category = $this->categoryRepository->ofCategoryId(new CategoryId($item[4]));

            $this->products[] = new Product(
                new ProductId($item[0]),
                new ProductName($item[1]),
                new ProductDescription($item[2]),
                new ProductImageUrl($item[3]),
                $category,
            );
        }
    }
}
