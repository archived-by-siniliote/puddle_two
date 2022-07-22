<?php

namespace App\Domain\Handler;

use App\Common\CQRS\CommandHandler;
use App\Domain\Command\ActionPost;
use App\Entity\BlogPost;
use App\Repository\PostRepository;
use Symfony\Component\Workflow\WorkflowInterface;

class ActionPostHandler implements CommandHandler
{
    private WorkflowInterface $workflow;

    public function __construct(WorkflowInterface $blogPublishingWorkflow, private readonly PostRepository $postRepository)
    {
        $this->workflow = $blogPublishingWorkflow;
    }

    public function __invoke(ActionPost $command): void
    {
        $post = $this->postRepository->find($command->post->getId());
        if (!$post) {
            return;
        }

        try {
            $this->toReview($post);
        } catch (\LogicException $exception) {
            dd($exception);
        }
    }

    public function toReview(BlogPost $post)
    {
        if ($this->workflow->can($post, 'to_review')) {
            $transition = 'to_review';
            $this->workflow->apply($post, $transition);
        }
    }

    public function publish(BlogPost $post)
    {
        if ($this->workflow->can($post, 'publish')) {
            $transition = 'publish';
            $this->workflow->apply($post, $transition);
        }
    }

    public function reject(BlogPost $post)
    {
        if ($this->workflow->can($post, 'reject')) {
            $transition = 'reject';
            $this->workflow->apply($post, $transition);
        }
    }
}
