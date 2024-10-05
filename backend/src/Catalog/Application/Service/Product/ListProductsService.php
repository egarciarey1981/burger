<?php

namespace Burger\Catalog\Application\Service\Product;

class ListProductsService extends ProductService
{
    public function execute(): ListProductsResponse
    {
        $products = $this->repository->all();

        $products = array_map(function ($product) {
            return $product->toArray();
        }, $products);

        return new ListProductsResponse($products);
    }
}