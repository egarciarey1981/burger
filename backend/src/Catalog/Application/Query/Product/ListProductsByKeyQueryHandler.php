<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Catalog\Application\Service\Product\ListProductsService;
use Burger\Catalog\Domain\Model\Product\ProductRepository;
use InvalidArgumentException;

class ListProductsByKeyQueryHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(ListProductsByKeyQuery $query): ListProductsByKeyResponse
    {
        $listProductsService = new ListProductsService($this->productRepository);
        $listProductsResponse = $listProductsService->execute();

        $products = $listProductsResponse->products();
        array_walk($products, function (&$product) {
            $product = $product->toArray();
        });

        $productsBy = $this->groupByKey($products, $query->key());

        return new ListProductsByKeyResponse($productsBy);
    }

    private function groupByKey(array $products, string $key): array
    {
        $productsBy = [];

        // Group products by key
        foreach ($products as $product) {
            if (!isset($product[$key]) || is_array($product[$key])) {
                throw new InvalidArgumentException('Invalid key');
            }
            $productsBy[$product[$key]][] = $product;
        }

        // Remove key from products
        foreach ($productsBy as &$products) {
            foreach ($products as &$product) {
                unset($product[$key]);
            }
        }

        return $productsBy;
    }
}
