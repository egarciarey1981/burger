<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\ViewProductQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    public function action(): Response
    {
        $propductId = $this->args['id'];

        $viewProductQuery = new ViewProductQuery($propductId);
        $viewProductResponse = $this->queryBus->handle($viewProductQuery);

        $data['product'] = $viewProductResponse->product();

        $this->logger->info('Product of id `' . $this->args['id'] . '` was viewed');

        return $this->respondWithData($data);
    }
}
