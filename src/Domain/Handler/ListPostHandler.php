<?php

namespace App\Domain\Handler;

use App\Common\CQRS\QueryHandler;
use App\Domain\Query\ListPost;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Criteria;

class ListPostHandler implements QueryHandler
{

    public function __construct(private readonly PostRepository $postRepository)
    {}

    public function __invoke(ListPost $query): array
    {
        $criteria = ($query->onlyPublished)?$this->published():$this->unpublished();
        $criteria->setMaxResults($query->limit);

        return $this->postRepository->matching($criteria)->toArray();
    }

    private function published(): Criteria {
        return Criteria::create()
            ->where(Criteria::expr()->neq('publishedAt', null));
    }

    private function unpublished(): Criteria {
        return Criteria::create()->where(Criteria::expr()->isNull('publishedAt'));
    }
}
