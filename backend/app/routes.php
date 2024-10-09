<?php

declare(strict_types=1);

use Burger\Catalog\Application\Action\Product\ListProductsByAction;
use Burger\Catalog\Application\Action\Product\ViewProductAction;
use Burger\Order\Application\Action\Order\CreateOrderAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/catalog', function (Group $group) {
        $group->group('/products', function (Group $group) {
            $group->get('/{id}', ViewProductAction::class);
            $group->get('/by/{key}', ListProductsByAction::class);
        });
    });

    $app->group('/order', function (Group $group) {
        $group->group('/orders', function (Group $group) {
            $group->post('', CreateOrderAction::class);
        });
    });
};
