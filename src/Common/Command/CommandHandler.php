<?php

declare(strict_types=1);

namespace App\Common\Command;

interface CommandHandler
{
    public function handle(Command $command): void;
}