<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Currency\CurrencyId;
use Burger\Catalog\Domain\Model\Currency\CurrencyRepository;
use Burger\Catalog\Domain\Model\Image\ImageId;
use Burger\Catalog\Domain\Model\Image\ImageRepository;
use Burger\Catalog\Domain\Model\Price\Price;
use Burger\Catalog\Domain\Model\Product\Product;
use Burger\Catalog\Domain\Model\Product\ProductDescription;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductName;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;
use Burger\Catalog\Domain\Model\Product\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    private CategoryRepository $categoryRepository;
    private CurrencyRepository $currencyRepository;
    private ImageRepository $imageRepository;
    private array $products = [];

    public function __construct(
        CategoryRepository $categoryRepository,
        CurrencyRepository $currencyRepository,
        ImageRepository $imageRepository,
        array $products = [],
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->currencyRepository = $currencyRepository;
        $this->imageRepository = $imageRepository;

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

    public function ofProductId(ProductId $id, bool $throwException = false): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id()->equals($id)) {
                return $product;
            }
        }

        if ($throwException) {
            throw new ProductNotFoundException('Product of id ' . $id->value() . ' not found');
        } else {
            return null;
        }
    }

    private function initialize(): void
    {
        $data = [
            [
                'id' => 'burger',
                'name' => 'Burger',
                'description' => 'Classic burger with beef, lettuce, tomato, onion, pickles, ketchup, and mustard',
                'image' => 'burger',
                'category' => 'burgers',
                'price_amount' => 5.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'cheeseburger',
                'name' => 'Cheeseburger',
                'description' => 'Classic burger with extra cheddar cheese',
                'image' => 'cheeseburger',
                'category' => 'burgers',
                'price_amount' => 7.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'chiken-burger',
                'name' => 'Chiken Burger',
                'description' => 'Crunchy chicken burger with lettuce, tomato, and mayonnaise',
                'image' => 'chiken-burger',
                'category' => 'burgers',
                'price_amount' => 6.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'fries',
                'name' => 'Fries',
                'description' => null,
                'image' => 'fried',
                'category' => 'starters',
                'price_amount' => 3.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'onion-rings',
                'name' => 'Onion Rings',
                'description' => null,
                'image' => 'onion-rings',
                'category' => 'starters',
                'price_amount' => 4.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'beer',
                'name' => 'Beer',
                'description' => null,
                'image' => 'beer',
                'category' => 'drinks',
                'price_amount' => 5.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'soft-drink',
                'name' => 'Soft Drink',
                'description' => null,
                'image' => 'soft-drink',
                'category' => 'drinks',
                'price_amount' => 2.50,
                'price_currency' => 'usd',
            ],
            [
                'id' => 'water',
                'name' => 'Water',
                'description' => null,
                'image' => 'water',
                'category' => 'drinks',
                'price_amount' => 1.50,
                'price_currency' => 'usd',
            ],
        ];

        foreach ($data as $item) {
            $this->products[] = new Product(
                new ProductId($item['id']),
                new ProductName($item['name']),
                is_null($item['description']) ? null : new ProductDescription($item['description']),
                $this->categoryRepository->ofCategoryId(new CategoryId($item['category']), true),
                new Price(
                    $item['price_amount'],
                    $this->currencyRepository->ofCurrencyId(new CurrencyId($item['price_currency']))
                ),
                $this->imageRepository->ofImageId(new ImageId($item['image'])),
            );
        }
    }
}
