<?php

declare(strict_types=1);

namespace App\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent('alert')]
class AlertComponent
{
    public string $message;
    public string $type = 'success';

    public function getIconClass(): string
    {
        return match ($this->type) {
            'success' => 'fa fa-circle-check',
            'danger' => 'fa fa-circle-exclamation',
        };
    }

    #[ExposeInTemplate('dismissible ')]
    public function canBeDismissed(): bool // available as `{{ dismissible  }}` in the template
    {
        return 'success' === $this->type;
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setDefaults(['type' => 'success']);
        $resolver->setAllowedValues('type', ['success', 'danger']);
        $resolver->setRequired('message');
        $resolver->setAllowedTypes('message', 'string');

        return $resolver->resolve($data);
    }

    public function mount(bool $isSuccess = true): void
    {
        $this->type = $isSuccess ? 'success' : 'danger';
    }
}
