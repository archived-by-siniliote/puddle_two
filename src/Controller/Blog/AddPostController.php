<?php

namespace App\Controller\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post', name: 'app_post_add', methods: Request::METHOD_POST)]
class AddPostController extends AbstractController
{
    public function __invoke()
    {

    }
}
