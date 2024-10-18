<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\View\ViewProductQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    public function action(): Response
    {
        $viewProductQueryResponse = $this->queryBus->handle(
            new ViewProductQuery(
                $this->args['id'],
                $this->request->getQueryParams()['currency'] ?? 'USD'
            ),
        );

        $this->logger->info('Product of id `' . $this->args['id'] . '` was viewed');

        return $this->respondWithData([
            'products' => $viewProductQueryResponse->product()
        ]);
    }
}
