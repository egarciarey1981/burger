<?php

namespace Backend\Shared\Domain\Model\Bus\Command;

interface CommandHandler
{
    public function handle(Command $command): void;
}