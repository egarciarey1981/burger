<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ListProductsGroupedByKeyQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsByAction extends Action
{
    public function action(): Response
    {
        $key = $this->args['key'];

        $queryResponse = $this->queryBus->handle(
            new ListProductsGroupedByKeyQuery($key)
        );

        $this->logger->info('Products grouped by key `' . $key . '` was viewed.');

        return $this->respondWithData([
            'key_values' => $queryResponse->productsGroupedByKey()
        ]);
    }
}
