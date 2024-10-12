<?php

namespace Burger\Catalog\Application\Service\Product\List;

use Burger\Catalog\Application\Service\Product\ProductService;

class ListProductsService extends ProductService
{
    public function execute(): ListProductsResponse
    {
        $products = $this->repository->all();

        return new ListProductsResponse(
            array_map(
                fn($product) => $product->toArray(),
                $products
            )   
        );
    }
}
