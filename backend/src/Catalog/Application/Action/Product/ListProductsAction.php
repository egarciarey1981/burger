<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\List\ListProductsQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends Action
{
    public function action(): Response
    {
        $listProductsQueryResponse = $this->queryBus->handle(
            new ListProductsQuery()
        );

        $this->logger->info('Products was viewed.');

        return $this->respondWithData([
            'products' => $listProductsQueryResponse->products()
        ]);
    }
}
