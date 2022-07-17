<?php

declare(strict_types=1);

namespace App\Common\CQRS;

interface QueryBus
{
    public function handle(Query $query): mixed;
}
