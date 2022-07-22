<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    #[Route('/post/{slug}', name: 'blog_post')]
    public function __invoke(BlogPost $post): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'post' => $post,
        ]);
    }
}
