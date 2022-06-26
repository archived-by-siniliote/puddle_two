<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\ChannelFactory;
use App\Factory\MessageFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MessageFactory::createMany(30, function () { // note the callback - this ensures that each of the 30 Messages has a different Channel with different author (User)
            return [
                'author' => UserFactory::random(),
                'channel' => ChannelFactory::random(),
            ]; // each comment set to a random User/Channel from those already in the database
        });

        $manager->flush();
    }
}
