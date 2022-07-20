<?php

namespace App\Domain\Query;

use App\Common\CQRS\Query;
use App\Message\SyncMessageInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostSort implements Query, SyncMessageInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $by,

        #[Assert\Choice(['ASC', 'DESC'])]
        public readonly string $order = 'DESC',
    ){}
}
