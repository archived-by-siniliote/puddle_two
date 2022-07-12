<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    use EntityIdTrait;
    use TimestampableTrait;

    #[ORM\Column(type: Types::STRING, length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['post.title'])]
    private string $slug;

    #[ORM\OneToOne(targetEntity: Post::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Post $post;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, cascade: ['persist'], orphanRemoval: true)]
    #[ORM\OrderBy(['publishedAt' => 'DESC'])]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }


    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setBlogPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBlogPost() === $this) {
                $comment->setBlogPost(null);
            }
        }

        return $this;
    }
}
