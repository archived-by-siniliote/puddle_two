<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Application\Command\ApplyForTheJob;

use SymfonyCraft\Puddle\Application\Command\CommandHandler;
use SymfonyCraft\Puddle\Domain\Applicant;
use SymfonyCraft\Puddle\Domain\ApplicantCollection;
use SymfonyCraft\Puddle\Domain\JobCollection;
use SymfonyCraft\Puddle\Domain\VO\Email;
use SymfonyCraft\Puddle\Domain\VO\Identifier;

final class ApplyForTheJobCommandHandler implements CommandHandler
{
    public function __construct(
        private JobCollection $jobCollection,
        private ApplicantCollection $applicantCollection
    ) {
    }

    public function __invoke(ApplyForTheJobCommand $command): void
    {
        $applicantEmail = new Email($command->getApplicantEmail());
        $jobId = new Identifier($command->getJobId());

        $job = $this->jobCollection->get($jobId);
        $applicant = $this->applicantCollection->find($applicantEmail);

        if (null === $applicant) {
            $applicant = Applicant::register($applicantEmail);
        }

        $applicant->apply($job);

        $this->applicantCollection->add($applicant);
    }
}
