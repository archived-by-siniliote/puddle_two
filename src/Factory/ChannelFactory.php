<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Channel;
use App\Repository\ChannelRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Channel>
 *
 * @method static        Channel|Proxy createOne(array $attributes = [])
 * @method static        Channel[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static        Channel|Proxy find(object|array|mixed $criteria)
 * @method static        Channel|Proxy findOrCreate(array $attributes)
 * @method static        Channel|Proxy first(string $sortedField = 'id')
 * @method static        Channel|Proxy last(string $sortedField = 'id')
 * @method static        Channel|Proxy random(array $attributes = [])
 * @method static        Channel|Proxy randomOrCreate(array $attributes = [])
 * @method static        Channel[]|Proxy[] all()
 * @method static        Channel[]|Proxy[] findBy(array $attributes)
 * @method static        Channel[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static        Channel[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static        ChannelRepository|RepositoryProxy repository()
 * @method Channel|Proxy create(array|callable $attributes = [])
 */
final class ChannelFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(10),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Channel $channel): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Channel::class;
    }
}
