<?php

namespace App\Twig;

use App\Common\CQRS\CommandBus;
use App\Domain\Command\ActionPost;
use App\Entity\BlogPost;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('action_post')]
class ActionPostComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public ?BlogPost $post = null;

    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    #[LiveAction]
    public function toReview()
    {
        $this->commandBus->dispatch(new ActionPost($this->post, 'to_review'));
    }

    #[LiveAction]
    public function publish()
    {
        $this->commandBus->dispatch(new ActionPost($this->post, 'publish'));
    }

    #[LiveAction]
    public function reject()
    {
        $this->commandBus->dispatch(new ActionPost($this->post, 'reject'));
    }
}
