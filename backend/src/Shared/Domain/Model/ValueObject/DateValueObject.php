<?php

namespace Burger\Shared\Domain\Model\ValueObject;

use DateTimeImmutable;

abstract class DateValueObject
{
    private DateTimeImmutable $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    abstract protected function assert(DateTimeImmutable $value): void;

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value()->format('Y-m-d');
    }

    public function equals(StringValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }
}