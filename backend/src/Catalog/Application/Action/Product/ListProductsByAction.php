<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ListProductsByKeyQuery;
use Burger\Shared\Application\Action\Action;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsByAction extends Action
{
    public function action(): Response
    {
        $key = $this->args['key'];

        $listProductsByKeyQuery = new ListProductsByKeyQuery($key);

        $listProductsByKeyResponse = $this->queryBus->handle($listProductsByKeyQuery);

        $products = $listProductsByKeyResponse->products();

        $this->logger->info('Products list was viewed');

        return $this->respondWithData($products);
    }
}
