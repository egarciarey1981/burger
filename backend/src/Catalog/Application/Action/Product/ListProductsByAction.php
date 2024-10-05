<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Service\Product\ListProductsService;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListProductsByAction extends Action
{
    private ListProductsService $listProductsService;

    public function __construct(
        LoggerInterface $logger,
        ListProductsService $listProductsService,
    ) {
        parent::__construct($logger);
        $this->listProductsService = $listProductsService;
    }

    public function action(): Response
    {
        $listProductsResponse = $this->listProductsService->execute();

        $products = $listProductsResponse->products();

        $key = $this->args['key'];

        $data = [];

        foreach ($products as $product) {
            $by = $product[$key];
            unset($product[$key]);
            $data[$by][] = $product;
        }

        $this->logger->info('Products list was viewed');

        return $this->respondWithJson($data);
    }
}
