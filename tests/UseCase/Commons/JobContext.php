<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use SymfonyCraft\Puddle\Tests\TestHelper\JobTestHelper;
use SymfonyCraft\Puddle\Tests\UseCase\Fake\FakeJobCollection;

final class JobContext implements Context
{
    public function __construct(
        private FakeJobCollection $jobCollection,
        private JobTestHelper $jobTestHelper
    ) {
    }

    /**
     * @Given these jobs are registered :
     */
    public function theseJobsAreRegistered(TableNode $table): void
    {
        $jobSnapshotsMap = $this->jobTestHelper->buildJobSnapshotsMapFromHash($table->getHash());
        $this->jobCollection->setFixture($jobSnapshotsMap);
    }
}
