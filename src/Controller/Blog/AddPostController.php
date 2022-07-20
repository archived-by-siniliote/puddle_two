<?php

namespace App\Controller\Blog;

use App\Common\CQRS\CommandBus;
use App\Domain\Command\AddPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post', name: 'app_post_add', methods: Request::METHOD_POST)]
class AddPostController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->commandBus->dispatch(new AddPost('Bisous', "Je t'aime"));

        return $this->json([], 200);
    }
}
