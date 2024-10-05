<?php

namespace Burger\Catalog\Domain\Model\Currency;

interface CurrencyRepository
{
    public function all(): array;
    public function ofCurrencyId(CurrencyId $CurrencyId): Currency;
}