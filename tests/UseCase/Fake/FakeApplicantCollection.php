<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase\Fake;

use SymfonyCraft\Puddle\Domain\Applicant;
use SymfonyCraft\Puddle\Domain\ApplicantCollection;
use SymfonyCraft\Puddle\Domain\VO\Email;

final class FakeApplicantCollection implements ApplicantCollection
{
    private array $applicantSnapshotsMap = [];

    public function find(Email $email): ?Applicant
    {
        if (isset($this->applicantSnapshotsMap[$email->get()])) {
            return Applicant::fromSnapshot($this->applicantSnapshotsMap[$email->get()]);
        }

        return null;
    }

    public function add(Applicant $applicant): void
    {
        $applicantSnapshot = $applicant->toSnapshot();
        $this->applicantSnapshotsMap[$applicantSnapshot['email']] = $applicantSnapshot;
    }

    public function getSnapshots(): array
    {
        return array_values($this->applicantSnapshotsMap);
    }

    public function setFixture(array $applicantSnapshotsMap): void
    {
        $this->applicantSnapshotsMap = $applicantSnapshotsMap;
    }
}
