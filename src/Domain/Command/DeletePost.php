<?php

namespace App\Domain\Command;

use App\Common\CQRS\Command;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;

class DeletePost implements Command
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly Ulid $id,
    ){}
}
