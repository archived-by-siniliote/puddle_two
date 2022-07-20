<?php

namespace App\DataFixtures;

use App\Factory\PostFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 Tag's
        TagFactory::createMany(20);

        PostFactory::new()
            ->many(15) // create 15 posts
            ->create(function() { // note the callback - this ensures that each of the 5 posts has a different random range
                return ['tags' => TagFactory::randomRange(0, 5)]; // each post uses between 0 and 5 random tags from those already in the database
            })
        ;

        $manager->flush();
    }
}
