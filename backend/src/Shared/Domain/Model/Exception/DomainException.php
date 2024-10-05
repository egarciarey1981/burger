<?php

namespace Burger\Shared\Domain\Model\Exception;

use Exception;

abstract class DomainException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}