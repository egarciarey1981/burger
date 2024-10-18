<?php

namespace Burger\Catalog\Application\Query\Product\View;

use Burger\Catalog\Application\Service\Product\View\ViewProductRequest;
use Burger\Catalog\Application\Service\Product\View\ViewProductService;
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

        $serviceRequest = new ViewProductRequest($query->productId(), $query->currency());
        $serviceResponse = $this->viewProductService->execute($serviceRequest);

        $product = $serviceResponse->product();

        return new ViewProductResponse($product);
    }
}
