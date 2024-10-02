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

    public function find(string $filter, int $page, int $limit): array
    {
        $products = [];

        foreach ($this->products as $product) {
            if (stripos($product->name()->value(), $filter) !== false) {
                $products[] = $product;
            }
        }
     
        return array_slice($products, ($page - 1) * $limit, $limit);
    }

    private function initialize(): void
    {
        $data = [
            ['burger', 'Burger', 'Burgers'],
            ['cheeseburger', 'Cheeseburger', 'Burgers'],
            ['chiken-burger', 'Chiken Burger', 'Burgers'],
            ['fries', 'Fries', 'Starters'],
            ['onion-rings', 'Onion Rings', 'Starters'],
            ['beer', 'Beer', 'Drinks'],
            ['soft-drink', 'Soft Drink', 'Drinks'],
            ['water', 'Water', 'Drinks'],
        ];

        foreach ($data as $item) {
            $this->products[] = new Product(
                new ProductId($item[0]),
                new ProductName($item[1]),
                new ProductCategory($item[2])
            );
        }
    }
}