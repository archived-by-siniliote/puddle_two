<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Notifier;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index', methods: Request::METHOD_GET)]
    #[Route('/search', name: 'blog_search', methods: Request::METHOD_GET)]
    public function __invoke(Request $request, NotifierInterface $notifier): Response
    {
        $query = $request->query->get('q', null);

        $notification = (new Notification('New Invoice', ['chat/mercure']))
            ->content('You got a new invoice for 15 EUR.');

        $notifier->send($notification, new NoRecipient());

        return $this->render('blog/index.html.twig', ['query' => $query]);
    }
}
