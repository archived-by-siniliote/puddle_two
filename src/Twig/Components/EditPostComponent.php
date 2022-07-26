<?php

namespace App\Twig\Components;

use App\Entity\BlogPost;
use App\Form\BlogPostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\Validator\Constraints as Assert;

#[AsLiveComponent('edit_post')]
final class EditPostComponent extends AbstractController
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;
    use ComponentWithFormTrait;

    #[LiveProp(exposed: ['title', 'body'])]
    #[Assert\Valid]
    public ?BlogPost $post = null;

    /**
     * Used to re-create the BlogPostType form for re-rendering.
     */
    protected function instantiateForm(): FormInterface
    {
        // we can extend AbstractController to get the normal shortcuts
        return $this->createForm(BlogPostFormType::class, $this->post);
    }

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager): RedirectResponse
    {
        $this->validate();
        $this->submitForm();

        /** @var BlogPost $post */
        $post = $this->getFormInstance()->getData();
        $entityManager->persist($post);
        $entityManager->flush();

        $this->addFlash('success', 'Post saved!');

        return $this->redirectToRoute('blog_post_show', [
            'slug' => $this->post->getSlug(),
        ]);
    }
}
