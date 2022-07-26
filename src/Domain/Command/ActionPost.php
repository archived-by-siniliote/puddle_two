<?php

namespace App\Domain\Command;

use App\Common\CQRS\Command;
use App\Entity\BlogPost;
use App\Message\AsyncMessageInterface;

class ActionPost implements Command
{
    public function __construct(
        public readonly BlogPost $post,
        public readonly string $transition
    )
    {
    }
}
