<?php

namespace Burger\Catalog\Domain\Model\Price;

use InvalidArgumentException;

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

    public function multiply(int $quantity): self
    {
        return new self(
            new PriceAmount($this->amount->value() * $quantity),
            $this->currency
        );
    }

    public function add(self $price): self
    {
        if (!$this->currency->equals($price->currency())) {
            throw new InvalidArgumentException('Cannot add prices with different currencies');
        }

        return new self(
            new PriceAmount($this->amount->value() + $price->amount()->value()),
            $this->currency
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount->value(),
            'currency' => (string)$this->currency,
        ];
    }
}
