<?php

namespace App\Message;

class CommentMessage implements AsyncMessageInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $reviewUrl,
        private readonly array $context = []
    ) {
    }

    public function getReviewUrl(): string
    {
        return $this->reviewUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
