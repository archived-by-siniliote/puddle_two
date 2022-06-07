<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
