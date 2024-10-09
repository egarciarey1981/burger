<?php

declare(strict_types=1);

use Burger\Catalog\Application\Query\Product\ListProductsByKeyQuery;
use Burger\Catalog\Application\Query\Product\ListProductsByKeyQueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryBus;
use Burger\Shared\Infrastructure\Bus\InMemory\InMemoryQueryBus;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        QueryBus::class => function (ContainerInterface $c) {
            $queryBus = new InMemoryQueryBus();

            $queryBus->register(ListProductsByKeyQuery::class, $c->get(ListProductsByKeyQueryHandler::class));

            return $queryBus;
        },
    ]);
};
