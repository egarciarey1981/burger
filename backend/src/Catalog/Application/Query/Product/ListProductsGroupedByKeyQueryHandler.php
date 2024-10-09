<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Catalog\Application\Service\Product\ListProductsService;
use Burger\Shared\Domain\Model\Bus\Query\Query;
use Burger\Shared\Domain\Model\Bus\Query\QueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;
use InvalidArgumentException;

class ListProductsGroupedByKeyQueryHandler implements QueryHandler
{
    private ListProductsService $listProductsService;

    public function __construct(ListProductsService $listProductsService)
    {
        $this->listProductsService = $listProductsService;
    }

    public function handle(Query $query): QueryResponse
    {
        if (!$query instanceof ListProductsGroupedByKeyQuery) {
            throw new InvalidArgumentException('Invalid query');
        }

        $listProductsResponse = $this->listProductsService->execute();

        $productsObject = $listProductsResponse->products();
        $productsArray = $this->productsToArray($productsObject);
        $productsGroupByKey = $this->groupByKey($productsArray, $query->key());

        return new ListProductsGroupedByKeyResponse($productsGroupByKey);
    }

    private function productsToArray(array $products): array
    {
        return array_map(function ($product) {
            return $product->toArray();
        }, $products);
    }

    private function groupByKey(array $products, string $key): array
    {
        $productsGroupedBy = [];

        foreach ($products as $product) {
            if (!isset($product[$key]) || is_array($product[$key])) {
                throw new InvalidArgumentException('Invalid key');
            }
            $keyValue = $product[$key];
            unset($product[$key]);
            $productsGroupedBy[$keyValue]['products'][] = $product;
        }

        return $productsGroupedBy;
    }
}
