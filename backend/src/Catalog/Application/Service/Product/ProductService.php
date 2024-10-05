<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductRepository;

abstract class ProductService
{
    protected ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
}