<?php
namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Psr\Log\LoggerInterface;

#[AsLiveComponent('random_number')]
class RandomNumberComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $min = 0;

    #[LiveProp(writable: true)]
    public int $max = 1000;

    #[LiveAction]
    public function resetMinMax(LoggerInterface $logger): void
    {
        $this->min = 0;
        $this->max = 1000;

        $logger->debug('The min/max were reset!');
    }

    public function getRandomNumber(): int
    {
        return rand($this->min, $this->max);
    }
}
