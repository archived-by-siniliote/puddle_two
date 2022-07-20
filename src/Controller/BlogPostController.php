<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    #[Route('/post/{slug}', name: 'blog_post')]
    public function __invoke(Post $post): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'post' => $post,
        ]);
    }
}
