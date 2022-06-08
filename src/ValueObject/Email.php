<?php

declare(strict_types=1);

namespace App\ValueObject;

final class Email
{
    public function __construct(
        private readonly string $value
    ) {
    }
}