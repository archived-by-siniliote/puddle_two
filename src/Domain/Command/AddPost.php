<?php

namespace App\Domain\Command;

use App\Common\CQRS\Command;
use App\Message\AsyncMessageInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AddPost implements Command, AsyncMessageInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $title,

        #[Assert\NotBlank]
        public readonly string $body,
    ){}
}
