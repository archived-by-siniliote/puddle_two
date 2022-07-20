<?php

namespace App\Domain\Query;

use App\Common\CQRS\Query;

class PostSearch implements Query
{
    public function __construct(
        public readonly ?string $query,
    ){}
}
