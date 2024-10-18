<?php

namespace Burger\Catalog\Application\Service\Product\List;

use Burger\Catalog\Application\Service\Product\ProductService;
use Burger\Catalog\Domain\Model\Currency;

class ListProductsService extends ProductService
{
    public function execute(ListProductsRequest $request): ListProductsResponse
    {
        $products = $this->repository->findByCurrency(
            new Currency($request->currency())
        );

        return new ListProductsResponse(
            array_map(
                fn($product) => $product->toArray(),
                $products
            )
        );
    }
}
