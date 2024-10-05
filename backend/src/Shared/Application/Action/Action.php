<?php

namespace Burger\Shared\Application\Action;

use Burger\Shared\Domain\Model\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

abstract class Action
{
    protected LoggerInterface $logger;
    protected Request $request;
    protected Response $response;
    protected array $args;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    abstract protected function action(): Response;

    public function __invoke(Request $request, Response $response, array $args): Response
    {

        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (NotFoundException $e) {
            return $this->respondWithJson(['error' => $e->getMessage()], 404);
        }
        
        return $this->respondWithJson([], 500);
    }

    protected function queryParam(string $name)
    {
        return $this->request->getQueryParams()[$name] ?? null;
    }

    protected function respond(int $statusCode): Response
    {
        return $this->response->withStatus($statusCode);
    }

    protected function respondWithJson(array $data, int $statusCode = 200): Response
    {
        $this->response->getBody()->write(json_encode($data));
        return $this->response
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }
}
