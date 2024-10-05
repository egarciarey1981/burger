<?php

namespace Burger\Catalog\Domain\Model\Product;

class ProductId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(ProductId $productId): bool
    {
        return $this->value() === $productId->value();
    }
}