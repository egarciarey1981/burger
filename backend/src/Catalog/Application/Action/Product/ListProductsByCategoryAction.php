<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ListGroupedByKey\ListProductsGroupedByKeyQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsByCategoryAction extends Action
{
    public function action(): Response
    {
        $key = 'category';
        $currency = $this->request->getQueryParams()['currency'] ?? 'USD';

        $query = new ListProductsGroupedByKeyQuery($key, $currency);
        $queryResponse = $this->queryBus->handle($query);

        $data[$key] = $queryResponse->productsGroupedByKey();

        $this->logger->info("Products grouped by `$key` was viewed.");

        return $this->respondWithData($data);
    }
}
