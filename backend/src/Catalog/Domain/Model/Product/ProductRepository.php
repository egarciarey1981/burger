<?php

namespace Burger\Catalog\Domain\Model\Product;

use Burger\Catalog\Domain\Model\Currency;

interface ProductRepository
{
    public function findByCurrency(Currency $currency): array;
    public function ofIdAndCurrency(ProductId $productId, Currency $currency): ?Product;
}
