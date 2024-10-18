<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ListGroupedByKey\ListProductsGroupedByKeyQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsByCategoryAction extends Action
{
    public function action(): Response
    {
        $listProductsGroupedByKeyQueryResponse = $this->queryBus->handle(
            new ListProductsGroupedByKeyQuery(
                'category',
                $this->request->getQueryParams()['currency'] ?? 'USD'
            )
        );

        $this->logger->info('Products grouped by category was viewed.');

        return $this->respondWithData([
            'categories' => $listProductsGroupedByKeyQueryResponse->productsGroupedByKey()
        ]);
    }
}
