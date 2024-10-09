<?php

namespace Burger\Catalog\Application\Query\Product;

use Burger\Catalog\Application\Service\Product\ViewProductRequest;
use Burger\Catalog\Application\Service\Product\ViewProductService;
use Burger\Catalog\Domain\Model\Product\ProductId;
use Burger\Shared\Domain\Model\Bus\Query\Query;
use Burger\Shared\Domain\Model\Bus\Query\QueryHandler;
use Burger\Shared\Domain\Model\Bus\Query\QueryResponse;
use InvalidArgumentException;

class ViewProductQueryHandler implements QueryHandler
{
    private ViewProductService $viewProductService;

    public function __construct(ViewProductService $viewProductService)
    {
        $this->viewProductService = $viewProductService;
    }

    public function handle(Query $query): QueryResponse
    {
        if (!$query instanceof ViewProductQuery) {
            throw new InvalidArgumentException('Invalid query');
        }

        $productId = new ProductId($query->productId());

        $viewProductResponse = new ViewProductRequest($productId);
        $viewProductResponse = $this->viewProductService->execute($viewProductResponse);

        $product = $viewProductResponse->product();

        return new ViewProductResponse($product);
    }
}