<?php

namespace Burger\Order\Application\Service\Order;

use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Catalog\Domain\Model\Product\ProductNotFoundException;
use Burger\Catalog\Domain\Model\Product\ProductRepository;
use Burger\Order\Domain\Model\Order\Order;
use Burger\Order\Domain\Model\Order\OrderDate;
use Burger\Order\Domain\Model\Order\OrderLine;
use Burger\Order\Domain\Model\Order\OrderLineQuantity;
use Burger\Order\Domain\Model\Order\OrderRepository;
use DateTimeImmutable;

class CreateOrderService extends OrderService
{
    private ProductRepository $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        ProductRepository $productRepository,
    )
    {
        $this->productRepository = $productRepository;
        parent::__construct($orderRepository);
    }

    public function execute(CreateOrderRequest $createOrderRequest): CreateOrderResponse
    {
        $order = new Order(
            $this->orderRepository->nextIdentity(),
            new OrderDate(new DateTimeImmutable()),
            $this->getOrderLines($createOrderRequest->orderLines()),
        );

        $this->orderRepository->save($order);

        return new CreateOrderResponse($order->toArray());
    }

    private function getOrderLines(array $lines): array
    {
        return array_map(function ($line) {
            $productId = new ProductId($line['productId']);
            $product = $this->productRepository->ofId($productId);
            $quantity = new OrderLineQuantity($line['quantity']);

            if (is_null($product)) {
                throw new ProductNotFoundException('Product of id ' . $line['productId'] . ' not found');
            }

            return new OrderLine($product, $quantity);
        }, $lines);
    }
}