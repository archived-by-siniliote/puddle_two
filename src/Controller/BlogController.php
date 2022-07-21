<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index')]
    #[Route('/search', name: 'blog_search', methods: Request::METHOD_GET)]
    public function __invoke(Request $request): Response
    {
        $query = $request->query->get('q', null);

        return $this->render('blog/index.html.twig', ['query' => $query]);
    }
}
