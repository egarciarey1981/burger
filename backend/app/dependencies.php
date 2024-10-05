<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $logger = new Logger('burger');

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler(__DIR__ . '/../log/burger.log', Level::Debug);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);
};
