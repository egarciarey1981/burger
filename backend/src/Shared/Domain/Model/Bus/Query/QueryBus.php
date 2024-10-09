<?php

namespace Burger\Shared\Domain\Model\Bus\Query;

interface QueryBus
{
    public function register(string $queryClass, QueryHandler $handler);
    public function handle(Query $query);
}
