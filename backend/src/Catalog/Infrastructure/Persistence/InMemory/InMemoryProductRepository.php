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
                '',
                '',
                'burgers',
            ],
            [
                'cheeseburger',
                'Cheeseburger',
                '',
                '',
                'burgers',
            ],
            [
                'chiken-burger',
                'Chiken Burger',
                '',
                '',
                'burgers',
            ],
            [
                'fries',
                'Fries',
                '',
                '',
                'starters',
            ],
            [
                'onion-rings',
                'Onion Rings',
                '',
                '',
                'starters',
            ],
            [
                'beer',
                'Beer',
                '',
                '',
                'drinks',
            ],
            [
                'soft-drink',
                'Soft Drink',
                '',
                '',
                'drinks',
            ],
            [
                'water',
                'Water',
                '',
                '',
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
