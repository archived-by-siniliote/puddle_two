<?php

namespace App\Twig\Components;

use Symfony\Component\Form\FormView;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('markdown_textarea')]
final class MarkdownTextareaComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public string $name;

    #[LiveProp(writable: true)]
    public string $value = '';

    #[LiveProp(writable: true)]
    public FormView $formView;
}
