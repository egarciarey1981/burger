<?php

namespace Burger\Orders\Domain\Model\Order;

use Burger\Shared\Domain\Model\ValueObject\DateValueObject;
use DateTimeImmutable;

class OrderDate extends DateValueObject
{
    protected function assert(DateTimeImmutable $date): void {}
}
