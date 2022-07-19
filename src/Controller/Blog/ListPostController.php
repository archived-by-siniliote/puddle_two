<?php

namespace App\Controller\Blog;

use App\Common\CQRS\QueryBus;
use App\Query\ListPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/posts', name: 'app_post_list', methods: Request::METHOD_GET)]
class ListPostController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        if(\count($posts = $this->getListPost())){
            return $this->json([], Response::HTTP_NO_CONTENT);
        }

        return $this->json($posts, Response::HTTP_OK);
    }

    private function getListPost(): array{
        return $this->queryBus->handle(new ListPost);
    }

}
