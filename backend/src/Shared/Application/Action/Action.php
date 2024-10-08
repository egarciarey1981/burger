<?php

namespace Burger\Shared\Application\Action;

use Burger\Shared\Domain\Model\Bus\Query\QueryBus;
use Burger\Shared\Domain\Model\Exception\NotFoundException;
use Exception;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

abstract class Action
{
    protected LoggerInterface $logger;
    protected Request $request;
    protected Response $response;
    protected array $args;
    protected QueryBus $queryBus;

    public function __construct(LoggerInterface $logger, QueryBus $queryBus)
    {
        $this->logger = $logger;
        $this->queryBus = $queryBus;
    }

    abstract protected function action(): Response;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (InvalidArgumentException $e) {
            return $this->respondWithData(['error' => $e->getMessage()], 400);
        } catch (NotFoundException $e) {
            return $this->respondWithData(['error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->respondWithData(['error' => 'Internal Server Error'], 500);
        }
    }

    protected function queryParam(string $name)
    {
        return $this->request->getQueryParams()[$name] ?? null;
    }

    protected function postParam(string $name)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        return $data[$name] ?? null;
    }

    protected function respondWithData(array $data, int $statusCode = 200): Response
    {
        $this->response->getBody()->write(json_encode($data));
        return $this->response
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json');
    }
}
