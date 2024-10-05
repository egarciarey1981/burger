<?php

namespace Burger\Catalog\Application\Service\Category;

use Burger\Catalog\Domain\Model\Product\ProductRepository;

class ListCategoriesWithProductsService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): ListCategoriesWithProductsResponse
    {
        $products = $this->productRepository->all();

        $categories = [];

        foreach ($products as $product) {
            $category = $product->category();

            if (!array_key_exists((string)$category->id(), $categories)) {
                $categories[(string)$category->id()] = [
                    'id' => (string)$category->id(),
                    'name' => (string)$category->name(),
                    'products' => []
                ];
            }

            $product = $product->toArray();
            unset($product['category']);
            unset($product['image']['id']);
            $product['price'] = sprintf($product['price']['currency']['format'], $product['price']['amount']);


            $categories[(string)$category->id()]['products'][] = $product;
        }

        return new ListCategoriesWithProductsResponse($categories);
    }
}
