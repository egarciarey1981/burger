<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\List\ListProductsQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends Action
{
    public function action(): Response
    {
        $currency = $this->request->getQueryParams()['currency'] ?? 'USD';

        $query = new ListProductsQuery($currency);
        $queryResponse = $this->queryBus->handle($query);

        $data['products'] = $queryResponse->products();

        $this->logger->info('Products was viewed.');

        return $this->respondWithData($data);
    }
}
