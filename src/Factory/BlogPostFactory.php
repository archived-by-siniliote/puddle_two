<?php

namespace App\Factory;

use App\Entity\BlogPost;
use App\EnumType\PostPlaceType;
use App\Repository\PostRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<BlogPost>
 *
 * @method static BlogPost|Proxy createOne(array $attributes = [])
 * @method static BlogPost[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static BlogPost|Proxy find(object|array|mixed $criteria)
 * @method static BlogPost|Proxy findOrCreate(array $attributes)
 * @method static BlogPost|Proxy first(string $sortedField = 'id')
 * @method static BlogPost|Proxy last(string $sortedField = 'id')
 * @method static BlogPost|Proxy random(array $attributes = [])
 * @method static BlogPost|Proxy randomOrCreate(array $attributes = [])
 * @method static BlogPost[]|Proxy[] all()
 * @method static BlogPost[]|Proxy[] findBy(array $attributes)
 * @method static BlogPost[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static BlogPost[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PostRepository|RepositoryProxy repository()
 * @method BlogPost|Proxy create(array|callable $attributes = [])
 */
final class BlogPostFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

    }

    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->sentence(3),
            'body' => self::faker()->paragraph(15),
            'current_place'=> ['Draft' => 'Draft']
        ];
    }

    public function published(): self
    {
        // call setPublishedAt() and pass a random DateTime
        return $this->addState(['published_at' => \DateTimeImmutable::createFromMutable(self::faker()->datetime())]);
    }

    public function unpublished(): self
    {
        return $this->addState(['published_at' => null]);
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Post $post): void {})
        ;
    }

    protected static function getClass(): string
    {
        return BlogPost::class;
    }
}
