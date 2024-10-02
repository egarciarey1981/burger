<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ListProductByCategoryService;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsByCategoryAction extends Action
{
    private ListProductByCategoryService $listProductByCategoryService;

    public function __construct(ListProductByCategoryService $listProductByCategoryService)
    {
        $this->listProductByCategoryService = $listProductByCategoryService;
    }

    public function action(): Response
    {
        $listProductByCategoryResponse = $this->listProductByCategoryService->execute();

        $data['categories'] = $listProductByCategoryResponse->categories();

        return $this->respondWithJson($data);
    }
}
