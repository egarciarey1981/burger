<?php

namespace Burger\Shared\Domain\Model\Bus\Query;

interface QueryBus
{
    public function register(string $queryClass, QueryHandler $handlerClass);
    public function handle(Query $query);
}
