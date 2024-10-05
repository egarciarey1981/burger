<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Category\CategoryId;
use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Currency\CurrencyId;
use Burger\Catalog\Domain\Model\Currency\CurrencyRepository;
use Burger\Catalog\Domain\Model\Image\ImageId;
use Burger\Catalog\Domain\Model\Image\ImageNotFoundException;
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

    public function ofProductId(ProductId $productId): Product
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
                'burger',
                'Burger',
                'Classic burger with beef, lettuce, tomato, onion, pickles, ketchup, and mustard',
                'burger',
                'burgers',
                6.50,
                'usd',
            ],
            [
                'cheeseburger',
                'Cheeseburger',
                'Classic burger with extra cheddar cheese',
                'cheeseburger',
                'burgers',
                7.50,
                'usd',
            ],
            [
                'chiken-burger',
                'Chiken Burger',
                'Crunchy chicken burger with lettuce, tomato, and mayonnaise',
                'chiken-burger',
                'burgers',
                6.50,
                'usd',
            ],
            [
                'fries',
                'Fries',
                null,
                'fried',
                'starters',
                3.50,
                'usd',
            ],
            [
                'onion-rings',
                'Onion Rings',
                null,
                'onion-rings',
                'starters',
                4.50,
                'usd',
            ],
            [
                'beer',
                'Beer',
                null,
                'beer',
                'drinks',
                5.50,
                'usd',
            ],
            [
                'soft-drink',
                'Soft Drink',
                null,
                'soft-drink',
                'drinks',
                2.50,
                'usd',
            ],
            [
                'water',
                'Water',
                null,
                'water',
                'drinks',
                1.50,
                'usd',
            ],
        ];

        foreach ($data as $item) {
            $category = $this->categoryRepository->ofCategoryId(new CategoryId($item[4]));
            $currency = $this->currencyRepository->ofCurrencyId(new CurrencyId($item[6]));
            $image = $this->imageRepository->ofImageId(new ImageId($item[3]));
            $price = new Price($item[5], $currency);

            $this->products[] = new Product(
                new ProductId($item[0]),
                new ProductName($item[1]),
                is_null($item[2]) ? null : new ProductDescription($item[2]),
                $image,
                $category,
                $price,
            );
        }
    }
}
