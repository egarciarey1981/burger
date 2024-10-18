<?php

namespace Burger\Catalog\Application\Query\Product\ListGroupedByKey;

use Burger\Catalog\Application\Service\Product\List\ListProductsRequest;
use Burger\Catalog\Application\Service\Product\List\ListProductsService;
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

        $serviceRequest = new ListProductsRequest($query->currency());
        $serviceResponse = $this->listProductsService->execute($serviceRequest);

        $products = $serviceResponse->products();
        $productsGroupedByKey = $this->groupByKey($products, $query->key());

        return new ListProductsGroupedByKeyResponse($productsGroupedByKey);
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
