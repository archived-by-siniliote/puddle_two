<?php

// config/packages/workflow.php
use App\Entity\BlogPost;
use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework) {
    $blogPublishing = $framework->workflows()->workflows('blog_publishing');
    $blogPublishing
        ->type('workflow') // or 'state_machine'
        ->supports([BlogPost::class])
        ->initialMarking(['Draft']);

    $blogPublishing->auditTrail()->enabled('%kernel.debug%');
    $blogPublishing->markingStore()
        ->type('method')
        ->property('currentPlace');

    $blogPublishing->place()->name('Draft');
    $blogPublishing->place()->name('Reviewed');
    $blogPublishing->place()->name('Rejected');
    $blogPublishing->place()->name('Published');

    $blogPublishing->transition()
        ->name('to_review')
        ->from(['Draft'])
        ->to(['Reviewed']);

    $blogPublishing->transition()
        ->name('publish')
        ->from(['Reviewed'])
        ->to(['Published'])
        ->metadata([
            'hour_limit' => 20,
            'explanation' => 'You can not publish after 8 PM.',
        ]);

    $blogPublishing->transition()
        ->name('reject')
        ->from(['Reviewed'])
        ->to(['Rejected']);
};
