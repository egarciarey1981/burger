<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ListProductService;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends Action
{
    private ListProductService $service;

    public function __construct(ListProductService $service)
    {
        $this->service = $service;
    }

    public function action(): Response
    {
        $response = $this->service->execute();

        $data['products'] = $response->products();

        return $this->respondWithJson($data);
    }
}
