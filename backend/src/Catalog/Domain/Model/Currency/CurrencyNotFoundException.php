<?php

namespace Burger\Catalog\Domain\Model\Currency;

use Burger\Shared\Domain\Model\Exception\NotFoundException;

class CurrencyNotFoundException extends NotFoundException
{
    public function __construct(string $message = 'Currency not found')
    {
        parent::__construct($message);
    }
}