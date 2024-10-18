<?php

namespace Burger\Catalog\Application\Query\Product\List;

use Burger\Catalog\Application\Service\Product\List\ListProductsRequest;
use Burger\Catalog\Application\Service\Product\List\ListProductsService;
use Burger\Shared\Domain\Model\Bus\Query\Query;
use Burger\Shared\Domain\Model\Bus\Query\QueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;
use InvalidArgumentException;

class ListProductsQueryHandler implements QueryHandler
{
    private ListProductsService $listProductsService;

    public function __construct(ListProductsService $listProductsService)
    {
        $this->listProductsService = $listProductsService;
    }

    public function handle(Query $query): QueryResponse
    {
        if (!$query instanceof ListProductsQuery) {
            throw new InvalidArgumentException('Invalid query');
        }

        $listProductsResponse = $this->listProductsService->execute(
            new ListProductsRequest(
                $query->currency()
            )
        );

        return new ListProductsQueryResponse(
            $listProductsResponse->products()
        );
    }
}
