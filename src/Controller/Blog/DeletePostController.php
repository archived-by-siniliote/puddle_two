<?php

namespace App\Controller\Blog;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/post/{slug}/delete', name: 'blog_post_delete', methods: [Request::METHOD_DELETE])]
class DeletePostController extends AbstractController
{
    public function __invoke(BlogPost $post): Response
    {
        return $this->renderForm('blog_post/edit.html.twig', [
            'post' => $post,
        ]);
    }
}
