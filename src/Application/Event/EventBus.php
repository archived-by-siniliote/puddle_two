<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Application\Event;

interface EventBus
{
    public function dispatch(Event $event): void;
}
