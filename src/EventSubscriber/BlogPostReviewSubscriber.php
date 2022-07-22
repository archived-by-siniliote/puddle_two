<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class BlogPostReviewSubscriber implements EventSubscriberInterface
{
    public function guardReview(GuardEvent $event)
    {
        /** @var BlogPost $post */
        $post = $event->getSubject();
        $title = $post->getTitle();

        if (empty($title)) {
            $event->setBlocked(true, 'This blog post cannot be marked as reviewed because it has no title.');
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.blog_publishing.guard.to_review' => ['guardReview'],
        ];
    }
}
