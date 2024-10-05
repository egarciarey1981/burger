<?php

namespace Burger\Shared\Domain\Model\ValueObject;

abstract class IntValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    abstract protected function assert(int $value): void;

    public function value(): int
    {
        return $this->value;
    }

    public function equals(IntValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }
}