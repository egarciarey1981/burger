<?php

namespace Burger\Shared\Domain\Model\ValueObject;

abstract class FloatValueObject
{
    private float $value;

    public function __construct(float $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    abstract protected function assert(float $value): void;

    public function value(): float
    {
        return $this->value;
    }

    public function equals(FloatValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }
}
