<?php

declare(strict_types=1);

use Burger\Catalog\Application\Action\Product\ListProductsByCategoryAction;
use Burger\Catalog\Application\Action\Product\ViewProductAction;
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
        $group->group('/product', function (Group $group) {
            $group->get('/category', ListProductsByCategoryAction::class);
            $group->get('/{id}', ViewProductAction::class);
        });
    });
};