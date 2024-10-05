<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;
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

        if (is_null($product)) {
            throw new ProductNotFoundException('Product of id ' . $request->id() . ' not found');
        }

        return new ViewProductResponse($product->toArray());
    }
}