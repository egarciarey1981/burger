<?php

namespace Burger\Catalog\Domain\Model\Product;

interface ProductRepository
{
    public function all(): array;
    public function ofProductId(ProductId $productId): Product;
}