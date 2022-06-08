<?php

declare(strict_types=1);

namespace App\ValueObject;

use Symfony\Component\Uid\Ulid;

final class Identifier
{
    public function __construct(
        private readonly Ulid $id
    ) {
    }

    public static function generateRandom(): self
    {
        return new self(new Ulid);
    }
}
