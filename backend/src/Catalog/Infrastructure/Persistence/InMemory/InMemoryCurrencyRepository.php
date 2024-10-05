<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Currency\Currency;
use Burger\Catalog\Domain\Model\Currency\CurrencyCode;
use Burger\Catalog\Domain\Model\Currency\CurrencyFormat;
use Burger\Catalog\Domain\Model\Currency\CurrencyId;
use Burger\Catalog\Domain\Model\Currency\CurrencyNotFoundException;
use Burger\Catalog\Domain\Model\Currency\CurrencyRepository;

class InMemoryCurrencyRepository implements CurrencyRepository
{
    private array $currencies = [];

    public function __construct(array $currencies = [])
    {
        if (empty($currencies)) {
            $this->initialize();
        } else {
            $this->currencies = $currencies;
        }
    }

    public function all(): array
    {
        return $this->currencies;
    }

    public function ofCurrencyId(CurrencyId $currencyId): ?Currency
    {
        foreach ($this->currencies as $currency) {
            if ($currency->id()->equals($currencyId)) {
                return $currency;
            }
        }

        return null;
    }

    private function initialize(): void
    {
        $data = [
            [
                'usd',
                'USD',
                '$%.2f',
            ],
            [
                'eur',
                'EUR',
                '%.2f€',
            ],
            [
                'gbp',
                'GBP',
                '£%.2f',
            ],
        ];

        foreach ($data as $currency) {
            $this->currencies[] = new Currency(
                new CurrencyId($currency[0]),
                new CurrencyCode($currency[1]),
                new CurrencyFormat($currency[2]),
            );
        }
    }
}