<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;

class ViewProductService extends ProductService
{
    public function execute(ViewProductRequest $viewProductRequest): ViewProductResponse
    {
        $productId = new ProductId($viewProductRequest->id());

        $product = $this->repository->ofId($productId);

        if ($product === null) {
            throw new ProductNotFoundException('Product of id ' . $productId->value() . ' not found');
        }

        return new ViewProductResponse($product->toArray());
    }
}