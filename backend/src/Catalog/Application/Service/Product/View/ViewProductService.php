<?php

namespace Burger\Catalog\Application\Service\Product\View;

use Burger\Catalog\Application\Service\Product\ProductService;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;

class ViewProductService extends ProductService
{
    public function execute(ViewProductRequest $viewProductRequest): ViewProductResponse
    {
        $product = $this->repository->ofId(
            new ProductId(
                $viewProductRequest->productId()
            )
        );

        if ($product === null) {
            throw new ProductNotFoundException('Product of id ' . $viewProductRequest->productId() . ' not found');
        }

        return new ViewProductResponse(
            $product->toArray()
        );
    }
}
