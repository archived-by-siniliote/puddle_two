<?php

namespace App\Domain\Query;

use App\Common\CQRS\Query;
use App\Message\SyncMessageInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ListPost implements Query
{
    public function __construct(
        #[Assert\Positive]
        public readonly int $limit = 10,
        #[Assert\Type('bool')]
        public readonly bool $onlyPublished = true,
    ){}
}
