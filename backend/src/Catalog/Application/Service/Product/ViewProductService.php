<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductRepository;

class ViewProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ViewProductRequest $request): ViewProductResponse
    {
        $productObject = $this->productRepository->ofProductId(
            new ProductId($request->id())
        );

        $productArray = [
            'id' => $productObject->id()->value(),
            'name' => $productObject->name()->value(),
            'category' => $productObject->category()->value(),
        ];

        return new ViewProductResponse($productArray);
    }
}