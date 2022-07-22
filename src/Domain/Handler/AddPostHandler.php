<?php

namespace App\Domain\Handler;

use App\Common\CQRS\CommandHandler;
use App\Domain\Command\AddPost;
use App\Entity\BlogPost;
use App\Repository\PostRepository;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class AddPostHandler implements CommandHandler
{


    public function __construct(private readonly PostRepository $postRepository, private HubInterface $hub)
    {
    }

    public function __invoke(AddPost $command){
        $post = (new BlogPost)
            ->setTitle($command->title)
            ->setBody($command->body);

        $this->postRepository->add($post);

        $this->publishProgress($post->getId(), 'ADD_POST', $post->getTitle());
    }

    private function publishProgress(string $id, string $type, $data = null)
    {
        $update = new Update(
            "post:$id",
            json_encode(['type' => $type, 'data' => $data]),
        );

        $this->hub->publish($update);
    }
}
