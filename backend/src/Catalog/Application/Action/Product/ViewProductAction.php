<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ViewProductQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    public function action(): Response
    {
        $productId = $this->args['id'];

        $queryResponse = $this->queryBus->handle(
            new ViewProductQuery($productId)
        );

        $this->logger->info('Product of id `' . $productId . '` was viewed');

        return $this->respondWithData([
            'products' => $queryResponse->product()
        ]);
    }
}
