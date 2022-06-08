<?php

declare(strict_types=1);

namespace App\Handler\Command;

use App\Common\Command\Command;
use App\Common\Command\CommandHandler;
use StellaMaris\Clock\CLockInterface;
use Doctrine\ORM\EntityManagerInterface;

final class CreateBlogPostCommandHandler implements CommandHandler
{
    public function __construct(
        private ClockInterface $clock,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /** @param CreateProductBlogPostCommand $command */
    public function handle(Command $command): void
    {
        $commandExecutedAt = $this->clock->now();

        // Validate
        $requestingUser = $this->userCollection->getOne($command->userId);
        $requestingUser->mustNotBeLocked();
        $requestingUser->mustHavePermissionToWriteArticle();

        // Apply
        $this->createNewsPost($command, $commandExecutedAt);
    }

    private function createNewsPost(
        CreateProductBlogPostCommand $command,
        \DateTimeImmutable $commandExecutedAt,
    ): void {
        $blogPostId = BlogPostId::generateRandom();
        $blogPost = new BlogPost(
            $blogPostId,
            $command->title,
            $command->content,
            $command->isPublished,
            $commandExecutedAt,
        );

        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();
    }
}