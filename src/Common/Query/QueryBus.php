<?php

declare(strict_types=1);

namespace App\Common\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;
}