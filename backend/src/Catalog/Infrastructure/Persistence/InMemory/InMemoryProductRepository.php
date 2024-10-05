<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Price\Price;
use Burger\Catalog\Domain\Model\Price\PriceAmount;
use Burger\Catalog\Domain\Model\Price\PriceCurrency;
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
                'price' => [
                    'amount' => 5.0,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'cheeseburger',
                'name' => 'Cheeseburger',
                'category' => 'Burgers',
                'price' => [
                    'amount' => 6.0,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'chiken-burger',
                'name' => 'Chiken Burger',
                'category' => 'Burgers',
                'price' => [
                    'amount' => 5.5,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'fries',
                'name' => 'Fries',
                'category' => 'Starters',
                'price' => [
                    'amount' => 2.5,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'onion-rings',
                'name' => 'Onion Rings',
                'category' => 'Starters',
                'price' => [
                    'amount' => 3.0,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'beer',
                'name' => 'Beer',
                'category' => 'Drinks',
                'price' => [
                    'amount' => 4.0,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'soft-drink',
                'name' => 'Soft Drink',
                'category' => 'Drinks',
                'price' => [
                    'amount' => 2.0,
                    'currency' => 'USD',
                ],
            ],
            [
                'id' => 'water',
                'name' => 'Water',
                'category' => 'Drinks',
                'price' => [
                    'amount' => 1.0,
                    'currency' => 'USD',
                ],
            ],
        ];

        foreach ($data as $item) {
            $this->products[] = new Product(
                new ProductId($item['id']),
                new ProductName($item['name']),
                new ProductCategory($item['category']),
                new Price(
                    new PriceAmount($item['price']['amount']),
                    new PriceCurrency($item['price']['currency'])
                ),
            );
        }
    }
}
