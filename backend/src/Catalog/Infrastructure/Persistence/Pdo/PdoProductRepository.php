<?php

namespace Burger\Catalog\Infrastructure\Persistence\Pdo;

use Burger\Catalog\Domain\Model\Currency;
use Burger\Catalog\Domain\Model\Price\Price;
use Burger\Catalog\Domain\Model\Price\PriceAmount;
use Burger\Catalog\Domain\Model\Product\Product;
use Burger\Catalog\Domain\Model\Product\ProductCategory;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductName;
use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Shared\Infrastructure\Persistence\Pdo\PdoRepository;

class PdoProductRepository extends PdoRepository implements ProductRepository
{
    public function findByCurrency(Currency $currency): array
    {
        $sql = 'SELECT * FROM products WHERE product_price_currency = :currency';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['currency' => $currency->value()]);
        $rows = $stmt->fetchAll();

        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product(
                new ProductId($row['product_id']),
                new ProductName($row['product_name']),
                new ProductCategory($row['product_category']),
                new Price(
                    new PriceAmount($row['product_price_amount']),
                    new Currency($row['product_price_currency'])
                )
            );
        }

        return $products;
    }

    public function ofIdAndCurrency(ProductId $productId, Currency $currency): ?Product
    {
        $sql = 'SELECT * FROM products WHERE product_id = :id AND product_price_currency = :currency';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $productId->value(), 'currency' => $currency->value()]);
        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return new Product(
            new ProductId($row['product_id']),
            new ProductName($row['product_name']),
            new ProductCategory($row['product_category']),
            new Price(
                new PriceAmount($row['product_price_amount']),
                new Currency($row['product_price_currency'])
            )
        );
    }
}
