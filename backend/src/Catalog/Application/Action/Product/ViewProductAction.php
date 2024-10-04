<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ViewProductRequest;
use Burger\Catalog\Application\Service\Product\ViewProductService;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    private ViewProductService $service;

    public function __construct(ViewProductService $service)
    {
        $this->service = $service;
    }

    public function action(): Response
    {
        $response = $this->service->execute(
            new ViewProductRequest($this->args['id'])
        );

        $data['product'] = $response->product();

        return $this->respondWithJson($data);
    }
}
