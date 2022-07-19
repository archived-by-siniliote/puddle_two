<?php

namespace App\Handler;

use App\Common\CQRS\QueryHandler;
use App\Query\ListPost;
use App\Repository\BlogPostRepository;

class ListPostHandler implements QueryHandler
{
    public function __construct(private readonly BlogPostRepository $blogPostRepository)
    {}

    public function __invoke(ListPost $query): array
    {
        return $this->blogPostRepository->findAll();
    }
}
