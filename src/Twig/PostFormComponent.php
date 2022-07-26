<?php

namespace App\Twig;

use App\Entity\BlogPost;
use App\Form\BlogPostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('post_form')]
class PostFormComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(exposed: ['title', 'body'])]
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
        // shortcut to submit the form with form values
        // if any validation fails, an exception is thrown automatically
        // and the component will be re-rendered with the form errors
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
