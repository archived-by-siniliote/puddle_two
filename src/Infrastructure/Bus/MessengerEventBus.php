<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Infrastructure\Bus;

use Symfony\Component\Messenger\MessageBusInterface;
use SymfonyCraft\Puddle\Application\Event\Event;
use SymfonyCraft\Puddle\Application\Event\EventBus;

final class MessengerEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }
}
