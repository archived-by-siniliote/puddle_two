<?php

namespace App\Entity;

use App\Loggable\Document\LogEntryPost;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[Gedmo\Loggable(logEntryClass: LogEntryPost::class)]
class Post
{
    use EntityIdTrait;
    use TimestampableTrait;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Gedmo\Versioned]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    #[Gedmo\Versioned]
    private string $body;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'created_by', referencedColumnName: 'id')]
    #[Gedmo\Blameable(on: 'create')]
    private User $createdBy;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'updated_by', referencedColumnName: 'id')]
    #[Gedmo\Blameable(on: 'update')]
    private User $updatedBy;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'content_changed_by', referencedColumnName: 'id')]
    #[Gedmo\Versioned]
    #[Gedmo\Blameable(on: 'change', field: ['title', 'body'])]
    private User $contentChangedBy;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setBody($body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedBy() :User
    {
        return $this->createdBy;
    }

    public function getUpdatedBy() :User
    {
        return $this->updatedBy;
    }

    public function getContentChangedBy()
    {
        return $this->contentChangedBy;
    }
}
