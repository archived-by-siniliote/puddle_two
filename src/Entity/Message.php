<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\Table(name: '`message`')]
#[ORM\HasLifecycleCallbacks]
class Message
{
    use EntityIdTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'text')]
    #[Groups(['message'])]
    private ?string $content;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    #[Groups(['message'])]
    private ?User $author;

    #[ORM\ManyToOne(targetEntity: Channel::class, inversedBy: 'messages')]
    private ?Channel $channel;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?UserInterface $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    public function setChannel(?Channel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}
