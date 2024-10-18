<?php

namespace Burger\Order\Application\Action\Order;

use Burger\Order\Application\Service\Order\CreateOrderRequest;
use Burger\Order\Application\Service\Order\CreateOrderService;
use Burger\Shared\Application\Action\Action;
use DateTimeImmutable;
use InvalidArgumentException;
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
        $date = new DateTimeImmutable();
        $orderLines = $this->getOrderLines();

        $createOrderRequest = new CreateOrderRequest(
            $date,
            $orderLines,
        );

        $createOrderResponse = $this->createOrderService->execute($createOrderRequest);

        $data['order'] = $createOrderResponse->order();
        
        $this->logger->info('Order was created');

        return $this->respondWithData($data, 201);
    }

    private function getOrderLines(): array
    {
        $lines = $this->postParam('lines');

        if (is_null($lines)) {
            throw new InvalidArgumentException('Missing `lines` parameter');
        }

        return array_map(function ($line) {
            return [
                'productId' => $line['product_id'],
                'quantity' => $line['quantity'],
            ];
        }, $lines);
    }
}
