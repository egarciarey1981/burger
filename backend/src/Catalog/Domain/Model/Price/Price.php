<?php

namespace Burger\Catalog\Domain\Model\Price;

use Burger\Catalog\Domain\Model\Currency;
use InvalidArgumentException;

class Price
{
    private PriceAmount $amount;
    private Currency $currency;

    public function __construct(PriceAmount $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): PriceAmount
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function multiply(int $quantity): self
    {
        $newAmount = $this->amount->value() * $quantity;

        $newPriceAmount = new PriceAmount($newAmount);

        $newPrice = new self($newPriceAmount, $this->currency);

        return $newPrice;
    }

    public function add(self $price): self
    {
        if (!$this->currency->equals($price->currency())) {
            throw new InvalidArgumentException('Cannot add prices with different currencies');
        }

        $newAmount = $this->amount->value() + $price->amount()->value();

        $newPriceAmount = new PriceAmount($newAmount);

        $newPrice = new self($newPriceAmount, $this->currency);

        return $newPrice;
    }

    public function toArray(): array
    {
        $price['amount'] = $this->amount->value();
        $price['currency'] = (string)$this->currency;

        return $price;
    }
}
