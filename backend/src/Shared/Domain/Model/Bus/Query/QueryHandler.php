<?php

namespace Burger\Shared\Domain\Model\Bus\Query;

interface QueryHandler
{
    public function __invoke(Query $query): QueryResponse;
}
