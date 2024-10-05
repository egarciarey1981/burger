<?php

namespace Burger\Catalog\Domain\Model\Currency;

class CurrencyId
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
        return $this->value();
    }

    public function equals(CurrencyId $CurrencyId): bool
    {
        return $this->value() === $CurrencyId->value();
    }
}