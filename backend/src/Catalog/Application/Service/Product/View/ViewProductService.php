<?php

namespace Burger\Catalog\Application\Service\Product\View;

use Burger\Catalog\Application\Service\Product\ProductService;
use Burger\Catalog\Domain\Model\Currency;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;

class ViewProductService extends ProductService
{
    public function execute(ViewProductRequest $viewProductRequest): ViewProductResponse
    {
        $productId = new ProductId($viewProductRequest->productId());
        $currency = new Currency($viewProductRequest->currency());

        $productObject = $this->repository->ofIdAndCurrency($productId, $currency);

        if ($productObject === null) {
            throw new ProductNotFoundException("Product of id `{$viewProductRequest->productId()}` not found");
        }

        $productArray = $productObject->toArray();

        return new ViewProductResponse($productArray);
    }
}
