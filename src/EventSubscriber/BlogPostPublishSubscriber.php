<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;
use Symfony\Component\Workflow\TransitionBlocker;

class BlogPostPublishSubscriber implements EventSubscriberInterface
{
    public function guardPublish(GuardEvent $event)
    {
        $eventTransition = $event->getTransition();
        $hourLimit = $event->getMetadata('hour_limit', $eventTransition);

        if (date('H') <= $hourLimit) {
            return;
        }

        // Block the transition "publish" if it is more than 8 PM
        // with the message for end user
        $explanation = $event->getMetadata('explanation', $eventTransition);
        $event->addTransitionBlocker(new TransitionBlocker($explanation , '0'));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.blog_publishing.guard.publish' => ['guardPublish'],
        ];
    }
}
