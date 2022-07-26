<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    #[Route('/post/{slug}', name: 'blog_post_show', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function __invoke(Request $request, BlogPost $post, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($this->getUser());
            $comment->setPost($post);
            $commentRepository->add($comment, true);
        }

        return $this->render('blog_post/index.html.twig', [
            'post' => $post,
            'comment_form' => $form->createView(),
        ]);
    }
}
