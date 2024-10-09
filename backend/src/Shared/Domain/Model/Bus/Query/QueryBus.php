<?php

namespace Burger\Shared\Domain\Model\Bus\Query;

interface QueryBus
{
    public function handle(Query $query);
}
