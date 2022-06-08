<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Domain;

use SymfonyCraft\Puddle\Domain\VO\Identifier;

interface JobCollection
{
    public function get(Identifier $id): Job;
}
