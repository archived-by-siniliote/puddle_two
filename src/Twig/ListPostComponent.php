<?php

namespace App\Twig;

use App\Common\CQRS\QueryBus;
use App\Domain\Query\ListPost;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('list_post')]
class ListPostComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public int $max = 10;

    #[LiveProp]
    public bool $isPublished = true;

    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function getPosts(): array
    {
        return $this->queryBus->ask(new ListPost($this->max, $this->isPublished));
    }
}
