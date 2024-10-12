<?php

declare(strict_types=1);

use Burger\Catalog\Application\Query\Product\List\ListProductsQuery;
use Burger\Catalog\Application\Query\Product\List\ListProductsQueryHandler;
use Burger\Catalog\Application\Query\Product\ListGroupedByKey\ListProductsGroupedByKeyQuery;
use Burger\Catalog\Application\Query\Product\ListGroupedByKey\ListProductsGroupedByKeyQueryHandler;
use Burger\Catalog\Application\Query\Product\View\ViewProductQuery;
use Burger\Catalog\Application\Query\Product\View\ViewProductQueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryBus;
use Burger\Shared\Infrastructure\Bus\InMemory\InMemoryQueryBus;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        QueryBus::class => function (ContainerInterface $c) {
            $queryBus = new InMemoryQueryBus();

            $queryBus->register(
                ListProductsQuery::class,
                $c->get(ListProductsQueryHandler::class),
            );
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
