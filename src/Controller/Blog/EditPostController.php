<?php

namespace App\Controller\Blog;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/post/{slug}/edit', name: 'blog_post_edit', methods: [Request::METHOD_GET])]
class EditPostController extends AbstractController
{
    public function __invoke(Request $request, BlogPost $post): Response
    {
        return $this->renderForm('blog_post/edit.html.twig', [
            'post' => $post,
        ]);
    }
}
