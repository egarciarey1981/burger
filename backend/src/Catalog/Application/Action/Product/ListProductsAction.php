<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ListProductsService;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends Action
{
    private ListProductsService $listProductsService;

    public function __construct(ListProductsService $listProductsService) {
        $this->listProductsService = $listProductsService;
    }

    public function action(): Response
    {
        $listProductsRequest = $this->listProductsService->execute();

        $data['products'] = $listProductsRequest->products();

        return $this->respondWithJson($data);
    }
}
