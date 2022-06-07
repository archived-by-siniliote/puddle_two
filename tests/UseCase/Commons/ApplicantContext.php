<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use SymfonyCraft\Puddle\Tests\TestHelper\ApplicantTestHelper;
use SymfonyCraft\Puddle\Tests\UseCase\Fake\FakeApplicantCollection;

final class ApplicantContext implements Context
{
    public function __construct(
        private FakeApplicantCollection $applicantCollection,
        private ApplicantTestHelper $applicantTestHelper
    ) {
    }

    /**
     * @Given these applicants are registered :
     */
    public function theseApplicantsAreRegistered(TableNode $table): void
    {
        $applicantSnapshotsMap = $this->applicantTestHelper->buildApplicantSnapshotsMapFromHash($table->getHash());
        $this->applicantCollection->setFixture($applicantSnapshotsMap);
    }

    /**
     * @Then these applicants should be registered :
     */
    public function theseApplicantsShouldBeRegistered(TableNode $table): void
    {
        $expectedApplicantSnapshots = $this->applicantTestHelper->buildApplicantSnapshotsFromHash($table->getHash());
        $applicantSnapshots = $this->applicantCollection->getSnapshots();

        Assert::assertEquals($expectedApplicantSnapshots, $applicantSnapshots);
    }
}
