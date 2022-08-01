<?php

namespace App\Domain\Handler;

use App\Common\CQRS\CommandHandler;
use App\Domain\Command\DeletePost;
use App\Entity\BlogPost;
use App\Repository\PostRepository;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class DeletePostHandler implements CommandHandler
{
    public function __construct(private readonly PostRepository $postRepository, private readonly HubInterface $hub)
    {
    }

    public function __invoke(DeletePost $command){

        $post = $this->postRepository->find($command->id);

        if($post){
            $this->postRepository->remove($post, true);
            $this->deleteProgress($post->getId(), 'DELETE_POST', $post->getTitle());
        } else {
            $this->deleteProgress($command->id, 'NOT_EXIST_POST');
        }

    }

    private function deleteProgress(string $id, string $type, $data = null)
    {
        $update = new Update(
            "post:$id",
            json_encode(['type' => $type, 'data' => $data]),
        );

        $this->hub->publish($update);
    }
}
