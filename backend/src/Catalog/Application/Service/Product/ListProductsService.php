<?php

namespace Burger\Catalog\Application\Service\Product;

class ListProductsService extends ProductService
{
    public function execute(): ListProductsResponse
    {
        $products = $this->repository->all();

        array_walk($products, function ($product) {
            $product->toArray();
        });

        return new ListProductsResponse($products);
    }
}
