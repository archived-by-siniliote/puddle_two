<?php

namespace App\Domain\Handler;

use App\Common\CQRS\QueryHandler;
use App\Domain\Query\PostSearch;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Criteria;

class PostSearchHandler implements QueryHandler
{
    public function __construct(private readonly PostRepository $postRepository)
    {}

    public function __invoke(PostSearch $query): array
    {
        if(empty($query->query))
            return $this->postRepository->findAll();

        return $this->postRepository->findBySearchQuery($query->query);
    }
}
