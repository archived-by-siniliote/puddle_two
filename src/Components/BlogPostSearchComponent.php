<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('blog_post_search')]
class BlogPostSearchComponent
{
    use DefaultActionTrait;

    public string $query = '';

//    public function __construct(private BlogPostRepository $blogPostRepository)
//    {}
//
//    public function getBlogPosts(): array
//    {
//        return $this->blogPostRepository->search($this->query);
//    }
}
