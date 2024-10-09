<?php

namespace Burger\Shared\Domain\Model\Bus\Query;

interface QueryHandler
{
    public function handle(Query $query): QueryResponse;
}
