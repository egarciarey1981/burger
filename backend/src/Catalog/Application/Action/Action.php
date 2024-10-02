<?php

namespace Burger\Catalog\Application\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{
    protected Request $request;
    protected Response $response;
    protected array $args;

    abstract protected function action(): Response;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->action();
    }

    protected function queryParam(string $name)
    {
        return $this->request->getQueryParams()[$name] ?? null;
    }

    protected function respond(int $statusCode): Response
    {
        return $this->response->withStatus($statusCode);
    }
    
    protected function respondWithJson(int $statusCode, $data): Response
    {
        $this->response->getBody()->write(json_encode($data));
        return $this->response
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }
}
