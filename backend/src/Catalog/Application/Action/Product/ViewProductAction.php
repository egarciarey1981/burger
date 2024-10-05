<?php

namespace Burger\Catalog\Application\Action\Product;

use Burger\Catalog\Application\Action\Action;
use Burger\Catalog\Application\Service\Product\ViewProductRequest;
use Burger\Catalog\Application\Service\Product\ViewProductService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewProductAction extends Action
{
    private ViewProductService $viewProductService;

    public function __construct(
        LoggerInterface $logger,
        ViewProductService $viewProductService,
    )
    {
        parent::__construct($logger);
        $this->viewProductService = $viewProductService;
    }

    public function action(): Response
    {
        $propductId = $this->args['id'];

        $viewProductRequest = new ViewProductRequest($propductId);

        $viewProductResponse = $this->viewProductService->execute($viewProductRequest);

        $data['product'] = $viewProductResponse->product();

        $this->logger->info('Product of id `' . $this->args['id'] . '` was viewed');

        return $this->respondWithJson($data);
    }
}
