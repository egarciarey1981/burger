<?php

namespace Burger\Shared\Domain\Exception;

abstract class NotFoundException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}