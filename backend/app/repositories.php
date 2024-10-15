<?php

declare(strict_types=1);

use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Catalog\Infrastructure\Persistence\Pdo\PdoProductRepository;
use Burger\Order\Domain\Model\Order\OrderRepository;
use Burger\Order\Infrastructure\Persistence\InMemory\InMemoryOrderRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        OrderRepository::class => \DI\autowire(InMemoryOrderRepository::class),
        ProductRepository::class => \DI\autowire(PdoProductRepository::class),
    ]);
};
