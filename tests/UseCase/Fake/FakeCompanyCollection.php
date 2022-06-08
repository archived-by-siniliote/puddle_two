<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase\Fake;

use SymfonyCraft\Puddle\Domain\CompanyCollection;

final class FakeCompanyCollection implements CompanyCollection
{
    public function setFixture(array $companySnapshotsMap): void
    {
    }
}
