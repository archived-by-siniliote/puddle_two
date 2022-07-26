<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: '`comment`')]
#[ORM\HasLifecycleCallbacks]
class Comment
{
    use EntityIdTrait;
    use TimestampableTrait;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?UserInterface $author;

    #[ORM\Column(type: 'text')]
    private string $text;

    #[ORM\Column(type: 'string', length: 255, options: ["default" => "submitted"])]
    private string $state = 'submitted';

    #[ORM\ManyToOne(targetEntity: BlogPost::class, inversedBy: 'comments')]
    private BlogPost $post;

    public function getAuthor(): ?UserInterface
    {
        return $this->author;
    }

    public function setAuthor(?UserInterface $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPost(): ?BlogPost
    {
        return $this->post;
    }

    public function setPost(?BlogPost $post): self
    {
        $this->post = $post;

        return $this;
    }
}
