<?php

namespace Burger\Shared\Domain\Model\ValueObject;

abstract class StringValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    abstract protected function assert(mixed $value): void;

    public function value(): mixed
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function equals(StringValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }
}