<?php

declare(strict_types=1);

use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryProductRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductRepository::class => \DI\autowire(InMemoryProductRepository::class),
    ]);
};