<?php

namespace Backend\Shared\Domain\Model\Bus\Command;

interface CommandBus
{
    public function register(string $commandClass, CommandHandler $handler);
    public function handle(Command $command);
}