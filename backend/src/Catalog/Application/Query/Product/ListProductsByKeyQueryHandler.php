<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Catalog\Application\Service\Product\ListProductsService;
use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Shared\Domain\Model\Bus\Query\QueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;
use InvalidArgumentException;

class ListProductsByKeyQueryHandler implements QueryHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(ListProductsByKeyQuery $query): QueryResponse
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

        foreach ($products as $product) {
            if (!isset($product[$key]) || is_array($product[$key])) {
                throw new InvalidArgumentException('Invalid key');
            }
            $keyValue = $product[$key];
            unset($product[$key]);
            $productsBy[$keyValue][] = $product;
        }

        return $productsBy;
    }
}
