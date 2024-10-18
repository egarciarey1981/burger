<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Query\Product\View\ViewProductQuery;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    public function action(): Response
    {
        $id = $this->args['id'];
        $currency = $this->request->getQueryParams()['currency'] ?? 'USD';

        $query = new ViewProductQuery($id, $currency);
        $queryResponse = $this->queryBus->handle($query);

        $data['products'] = $queryResponse->product();

        $this->logger->info("Product of id `$id` was viewed");

        return $this->respondWithData($data);
    }
}
