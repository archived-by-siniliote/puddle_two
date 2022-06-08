<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Application\Query;

interface QueryBus
{
    public function handle(Query $query): ViewModel;
}
