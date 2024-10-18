<?php

namespace Burger\Catalog\Application\Service\Product\List;

use Burger\Catalog\Application\Service\Product\ProductService;
use Burger\Catalog\Domain\Model\Currency;

class ListProductsService extends ProductService
{
    public function execute(ListProductsRequest $request): ListProductsResponse
    {
        $currency = new Currency($request->currency());

        $productsObjects = $this->repository->findByCurrency($currency);

        $productsArrays = $this->productsToArrays($productsObjects);

        return new ListProductsResponse($productsArrays);
    }

    private function productsToArrays(array $productsObjects): array
    {
        $productsArrays = [];

        foreach ($productsObjects as $product) {
            $productsArrays[] = $product->toArray();
        }

        return $productsArrays;
    }
}
