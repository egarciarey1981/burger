<?php

namespace Burger\Order\Application\Action\Order;

use Burger\Order\Application\Service\Order\CreateOrderRequest;
use Burger\Order\Application\Service\Order\CreateOrderService;
use Burger\Shared\Application\Action\Action;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateOrderAction extends Action
{
    private CreateOrderService $createOrderService;

    public function __construct(
        LoggerInterface $logger,
        CreateOrderService $createOrderService,
    ) {
        parent::__construct($logger);
        $this->createOrderService = $createOrderService;
    }

    public function action(): Response
    {
        $createOrderRequest = new CreateOrderRequest(
            new DateTimeImmutable(),
        );

        $this->createOrderService->execute($createOrderRequest);

        $this->logger->info('Order was created');

        return $this->respond(201);
    }
}
