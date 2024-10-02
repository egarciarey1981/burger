<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ViewProductRequest;
use Burger\Catalog\Application\Service\Product\ViewProductService;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    private ViewProductService $viewProductService;

    public function __construct(ViewProductService $viewProductService)
    {
        $this->viewProductService = $viewProductService;
    }

    public function action(): Response
    {
        $viewProductRespone = $this->viewProductService->execute(
            new ViewProductRequest($this->args['id'])
        );

        $data['product'] = $viewProductRespone->product();

        return $this->respondWithJson($data);
    }
}
