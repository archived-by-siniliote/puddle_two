<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase;

use Behat\Behat\Context\Context;
use SymfonyCraft\Puddle\Application\Command\ApplyForTheJob\ApplyForTheJobCommand;
use SymfonyCraft\Puddle\Application\Command\CommandBus;

final class ApplyForTheJobContext implements Context
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    /**
     * @When I apply for the job :jobId with the email :applicantEmail
     */
    public function iApplyForTheJobWithTheId(string $jobId, string $applicantEmail): void
    {
        $applyForTheJobCommand = new ApplyForTheJobCommand($jobId, $applicantEmail);
        $this->commandBus->dispatch($applyForTheJobCommand);
    }
}
