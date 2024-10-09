<?php

namespace Burger\Shared\Infrastructure\Bus\InMemory;

use Burger\Shared\Domain\Model\Bus\Query\Query;
use Burger\Shared\Domain\Model\Bus\Query\QueryBus;
use Burger\Shared\Domain\Model\Bus\Query\QueryHandler;

class InMemoryQueryBus implements QueryBus
{
    private $handlers = [];

    public function register(string $queryClass, QueryHandler $handlerClass)
    {
        $this->handlers[$queryClass] = $handlerClass;
    }

    public function handle(Query $query)
    {
        $queryClass = get_class($query);

        $handler = $this->handlers[$queryClass];

        return $handler($query);
    }
}
