<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use SymfonyCraft\Puddle\Tests\TestHelper\CompanyTestHelper;
use SymfonyCraft\Puddle\Tests\UseCase\Fake\FakeCompanyCollection;

final class CompanyContext implements Context
{
    public function __construct(
        private FakeCompanyCollection $companyCollection,
        private CompanyTestHelper $companyTestHelper,
    ) {
    }

    /**
     * @Given these companies are registered :
     */
    public function theseCompanyAreRegistered(TableNode $table): void
    {
        $companySnapshotsMap = $this->companyTestHelper->buildCompanySnapshotsMapFromHash($table->getHash());
        $this->companyCollection->setFixture($companySnapshotsMap);
    }
}
