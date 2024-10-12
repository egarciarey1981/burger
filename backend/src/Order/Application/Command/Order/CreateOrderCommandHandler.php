<?php

namespace Backend\Order\Application\Command\Order;

use Backend\Shared\Domain\Model\Bus\Command\Command;
use Backend\Shared\Domain\Model\Bus\Command\CommandHandler;
use Burger\Order\Application\Service\Order\CreateOrderRequest;
use Burger\Order\Application\Service\Order\CreateOrderService;
use InvalidArgumentException;

class CreateOrderCommandHandler implements CommandHandler
{
    private CreateOrderService $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function handle(Command $command): void
    {
        if (!$command instanceof CreateOrderCommand) {
            throw new InvalidArgumentException('Invalid command');
        }

        $createOderRequest = new CreateOrderRequest($command->date(), $command->lines());
        $this->createOrderService->execute($createOderRequest);
    }
}