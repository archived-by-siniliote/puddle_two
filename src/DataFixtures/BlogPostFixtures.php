<?php

namespace App\DataFixtures;

use App\Factory\BlogPostFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogPostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 Tag's
        TagFactory::createMany(20);

        BlogPostFactory::new()
            ->published()
            ->many(15) // create 15 posts published
            ->create($this->randomAttributes())
        ;

        BlogPostFactory::new()
            ->unpublished()
            ->many(5) // create 5 posts unpublished
            ->create($this->randomAttributes())
        ;

        $manager->flush();
    }

    /**
     * This ensures that each of the posts has a different random Attributes
     * @return array
     */
    public function randomAttributes(): array {
        return [
            'author' => UserFactory::random(),
            'tags' => TagFactory::randomRange(0, 5)
        ]; // each post uses between 0 and 5 random tags from those already in the database
    }
}
