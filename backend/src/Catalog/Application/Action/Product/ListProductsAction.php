<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Service\Product\ListProductsService;
use Burger\Shared\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListProductsAction extends Action
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
        $listProductsRequest = $this->listProductsService->execute();

        $data['products'] = $listProductsRequest->products();

        $this->logger->info('Products list was viewed');

        return $this->respondWithJson($data);
    }
}
