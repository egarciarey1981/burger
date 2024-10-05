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

    public function ofCurrencyId(CurrencyId $id, bool $throwException = false): ?Currency
    {
        foreach ($this->currencies as $currency) {
            if ($currency->id()->equals($id)) {
                return $currency;
            }
        }

        if ($throwException) {
            throw new CurrencyNotFoundException($id);
        } else {
            return null;
        }
    }

    private function initialize(): void
    {
        $data = [
            [
                'id' => 'usd',
                'code' => 'USD',
                'format' => '$%.2f',
            ],
            [
                'id' => 'eur',
                'code' => 'EUR',
                'format' => '€%.2f',
            ],
            [
                'id' => 'gbp',
                'code' => 'GBP',
                'format' => '£%.2f',
            ],
        ];

        foreach ($data as $currency) {
            $this->currencies[] = new Currency(
                new CurrencyId($currency['id']),
                new CurrencyCode($currency['code']),
                new CurrencyFormat($currency['format'])
            );
        }
    }
}