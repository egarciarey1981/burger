<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductRepository;

class ViewProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ViewProductRequest $request): ViewProductResponse
    {
        $product = $this->repository->ofProductId(
            new ProductId($request->id())
        );

        $product = [
            'id' => $product->id()->value(),
            'name' => $product->name()->value(),
            'category' => $product->category()->value(),
        ];

        return new ViewProductResponse($product);
    }
}