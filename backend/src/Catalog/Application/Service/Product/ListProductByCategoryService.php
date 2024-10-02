<?php

namespace Burger\Catalog\Application\Service\Product;

use Burger\Catalog\Domain\Model\Product\ProductRepository;

class ListProductByCategoryService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): ListProductByCategoryResponse
    {
        $categories = [];

        foreach ($this->productRepository->all() as $product) {
            $categories[$product->category()->value()][] = [
                'id' => $product->id()->value(),
                'name' => $product->name()->value(),
            ];
        }

        return new ListProductByCategoryResponse($categories);
    }
}
