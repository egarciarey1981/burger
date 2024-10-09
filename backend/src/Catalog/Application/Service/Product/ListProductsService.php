<?php

namespace Burger\Catalog\Application\Service\Product;

class ListProductsService extends ProductService
{
    public function execute(): ListProductsResponse
    {
        $products = $this->repository->all();

        return new ListProductsResponse($products);
    }
}
