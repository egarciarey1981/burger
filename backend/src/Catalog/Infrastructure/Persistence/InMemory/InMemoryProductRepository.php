<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Currency;
use Burger\Catalog\Domain\Model\Price\Price;
use Burger\Catalog\Domain\Model\Price\PriceAmount;
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
            $products = $this->productsToInitialize();
        }

        $this->products = $products;
    }

    public function findByCurrency(Currency $currency): array
    {
        return array_filter($this->products, function (Product $product) use ($currency) {
            return $product->price()->currency()->equals($currency);
        });
    }

    public function ofIdAndCurrency(ProductId $productId, Currency $currency): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id()->equals($productId) && $product->price()->currency()->equals($currency)) {
                return $product;
            }
        }

        return null;
    }

    private function productsToInitialize(): array
    {
        $dataProducts = [
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

        $dataExchangeRates = [
            'USD' => 1.0,
            'EUR' => 0.85,
            'GBP' => 0.75,
        ];

        foreach ($dataProducts as $dataProduct) {
            foreach ($dataExchangeRates as $currency => $exchangeRate) {
                $products[] = new Product(
                    new ProductId($dataProduct['id']),
                    new ProductName($dataProduct['name']),
                    new ProductCategory($dataProduct['category']),
                    new Price(
                        new PriceAmount($dataProduct['price']['amount'] * $exchangeRate),
                        new Currency($currency)
                    ),
                );
            }
        }

        return $products;
    }
}
