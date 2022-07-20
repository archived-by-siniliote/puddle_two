<?php

namespace App\Domain\Handler;

use App\Common\CQRS\QueryHandler;
use App\Domain\Query\ListPost;
use App\Repository\PostRepository;

class ListPostHandler implements QueryHandler
{
    public function __construct(private readonly PostRepository $postRepository)
    {}

    public function __invoke(ListPost $query): array
    {
        return $this->postRepository->findBy([], limit: $query->limit);
    }
}
