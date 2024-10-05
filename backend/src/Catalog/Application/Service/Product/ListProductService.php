<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductRepository;

class ListProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): ListProductResponse
    {
        $products = $this->repository->all();

        array_walk($products, function (&$product) {
            $product = $product->toArray();
        });

        return new ListProductResponse($products);
    }
}
