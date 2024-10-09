<?php

declare(strict_types=1);

use Burger\Catalog\Application\Query\Product\ListProductsGroupedByKeyQuery;
use Burger\Catalog\Application\Query\Product\ListProductsGroupedByKeyQueryHandler;
use Burger\Catalog\Application\Query\Product\ViewProductQuery;
use Burger\Catalog\Application\Query\Product\ViewProductQueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryBus;
use Burger\Shared\Infrastructure\Bus\InMemory\InMemoryQueryBus;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        QueryBus::class => function (ContainerInterface $c) {
            $queryBus = new InMemoryQueryBus();

            $queryBus->register(
                ListProductsGroupedByKeyQuery::class,
                $c->get(ListProductsGroupedByKeyQueryHandler::class),
            );
            $queryBus->register(
                ViewProductQuery::class,
                $c->get(ViewProductQueryHandler::class),
            );

            return $queryBus;
        },
    ]);
};
