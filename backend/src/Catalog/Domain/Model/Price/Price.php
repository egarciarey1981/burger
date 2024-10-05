<?php

namespace Burger\Catalog\Domain\Model\Price;

class Price
{
    private PriceAmount $amount;
    private PriceCurrency $currency;

    public function __construct(
        PriceAmount $amount,
        PriceCurrency $currency,
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): PriceAmount
    {
        return $this->amount;
    }

    public function currency(): PriceCurrency
    {
        return $this->currency;
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount->value(),
            'currency' => (string)$this->currency,
        ];
    }
}
