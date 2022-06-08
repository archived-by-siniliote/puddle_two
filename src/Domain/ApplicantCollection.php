<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Domain;

use SymfonyCraft\Puddle\Domain\VO\Email;

interface ApplicantCollection
{
    public function find(Email $email): ?Applicant;

    public function add(Applicant $applicant): void;
}
