<?php

namespace App\Components;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('message')]
class MessageComponent extends AbstractController
{
    public ?User $author = null;
    public ?Message $message = null;

    public function getUsername(): ?string
    {
        return $this->author?->getUsername() ?? null;
    }

    public function isOwner(): ?bool
    {
        return $this->getUser() === $this->author;
    }

    public function getContent(): ?string
    {
        return $this->message?->getContent();
    }

    public function getDateTime(): ?\DateTime
    {
        return $this->message?->getCreatedAt();
    }
}
