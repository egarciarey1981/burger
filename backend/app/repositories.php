<?php

declare(strict_types=1);

use Burger\Catalog\Domain\Model\Product\ProductRepository as CatalogProductRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryProductRepository as CatalogInMemoryProductRepository;
use Burger\Catalog\Infrastructure\Persistence\Pdo\PdoProductRepository as CatalogPdoProductRepository;
use Burger\Orders\Domain\Model\Order\OrderRepository as OrdersOrderRepository;
use Burger\Orders\Infrastructure\Persistence\InMemory\InMemoryOrderRepository as InMemoryOrdersOrderRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        //CatalogProductRepository::class => \DI\autowire(CatalogPdoProductRepository::class),
        CatalogProductRepository::class => \DI\autowire(CatalogInMemoryProductRepository::class),
        OrdersOrderRepository::class => \DI\autowire(InMemoryOrdersOrderRepository::class),
    ]);
};
