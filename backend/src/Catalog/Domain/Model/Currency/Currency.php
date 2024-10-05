<?php

namespace Burger\Catalog\Domain\Model\Currency;

class Currency
{
    private CurrencyId $id;
    private CurrencyCode $code;
    private CurrencyFormat $format;

    public function __construct(
        CurrencyId $id,
        CurrencyCode $code,
        CurrencyFormat $format,
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->format = $format;
    }

    public function id(): CurrencyId
    {
        return $this->id;
    }

    public function code(): CurrencyCode
    {
        return $this->code;
    }

    public function format(): CurrencyFormat
    {
        return $this->format;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'code' => (string) $this->code,
            'format' => (string) $this->format,
        ];
    }
}
