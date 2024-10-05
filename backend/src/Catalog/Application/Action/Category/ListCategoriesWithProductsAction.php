<?php

namespace Burger\Catalog\Application\Action\Category;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Category\ListCategoriesWithProductsService;
use Psr\Http\Message\ResponseInterface as Response;

class ListCategoriesWithProductsAction extends Action
{
    private ListCategoriesWithProductsService $service;

    public function __construct(ListCategoriesWithProductsService $service)
    {
        $this->service = $service;
    }

    public function action(): Response
    {
        $response = $this->service->execute();

        $data['categories'] = $response->categories();

        return $this->respondWithJson($data);
    }
}
