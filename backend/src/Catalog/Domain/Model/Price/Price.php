<?php

namespace Burger\Catalog\Domain\Model\Price;

use Burger\Catalog\Domain\Model\Currency\Currency;

class Price
{
    private float $amount;
    private Currency $currency;

    public function __construct(
        float $amount,
        Currency $currency,
    )
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency->toArray(),
        ];
    }
}
