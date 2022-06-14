<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\ChannelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChannelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ChannelFactory::createMany(5);

        $manager->flush();
    }
}
