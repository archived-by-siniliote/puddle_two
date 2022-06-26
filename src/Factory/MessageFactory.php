<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Message>
 *
 * @method static        Message|Proxy createOne(array $attributes = [])
 * @method static        Message[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static        Message|Proxy find(object|array|mixed $criteria)
 * @method static        Message|Proxy findOrCreate(array $attributes)
 * @method static        Message|Proxy first(string $sortedField = 'id')
 * @method static        Message|Proxy last(string $sortedField = 'id')
 * @method static        Message|Proxy random(array $attributes = [])
 * @method static        Message|Proxy randomOrCreate(array $attributes = [])
 * @method static        Message[]|Proxy[] all()
 * @method static        Message[]|Proxy[] findBy(array $attributes)
 * @method static        Message[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static        Message[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static        MessageRepository|RepositoryProxy repository()
 * @method Message|Proxy create(array|callable $attributes = [])
 */
final class MessageFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Message $message): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Message::class;
    }
}
