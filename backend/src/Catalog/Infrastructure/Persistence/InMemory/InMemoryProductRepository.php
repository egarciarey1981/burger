<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Product\Product;
use Burger\Catalog\Domain\Model\Product\ProductCategory;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductName;
use Burger\Catalog\Domain\Model\Product\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    private array $products = [];

    public function __construct(array $products = [])
    {
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

    public function ofId(ProductId $productId): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id()->equals($productId)) {
                return $product;
            }
        }

        return null;
    }

    private function initialize(): void
    {
        $data = [
            [
                'id' => 'burger',
                'name' => 'Burger',
                'category' => 'Burgers',
            ],
            [
                'id' => 'cheeseburger',
                'name' => 'Cheeseburger',
                'category' => 'Burgers',
            ],
            [
                'id' => 'chiken-burger',
                'name' => 'Chiken Burger',
                'category' => 'Burgers',
            ],
            [
                'id' => 'fries',
                'name' => 'Fries',
                'category' => 'Starters',
            ],
            [
                'id' => 'onion-rings',
                'name' => 'Onion Rings',
                'category' => 'Starters',
            ],
            [
                'id' => 'beer',
                'name' => 'Beer',
                'category' => 'Drinks',
            ],
            [
                'id' => 'soft-drink',
                'name' => 'Soft Drink',
                'category' => 'Drinks',
            ],
            [
                'id' => 'water',
                'name' => 'Water',
                'category' => 'Drinks',
            ],
        ];

        foreach ($data as $item) {
            $this->products[] = new Product(
                new ProductId($item['id']),
                new ProductName($item['name']),
                new ProductCategory($item['category']),
            );
        }
    }
}
