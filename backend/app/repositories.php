<?php

declare(strict_types=1);

use Burger\Catalog\Domain\Model\Category\CategoryRepository;
use Burger\Catalog\Domain\Model\Currency\CurrencyRepository;
use Burger\Catalog\Domain\Model\Image\ImageRepository;
use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryCategoryRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryCurrencyRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryImageRepository;
use Burger\Catalog\Infrastructure\Persistence\InMemory\InMemoryProductRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        CategoryRepository::class => \DI\autowire(InMemoryCategoryRepository::class),
        CurrencyRepository::class => \DI\autowire(InMemoryCurrencyRepository::class),
        ImageRepository::class => \DI\autowire(InMemoryImageRepository::class),
        ProductRepository::class => \DI\autowire(InMemoryProductRepository::class),
    ]);
};