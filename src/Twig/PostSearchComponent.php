<?php

namespace App\Twig;

use App\Common\CQRS\QueryBus;
use App\Domain\Query\PostSearch;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('post_search')]
class PostSearchComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?string $query = null;

    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function getPosts(): array
    {
        return $this->queryBus->ask(new PostSearch($this->query));
    }
}
