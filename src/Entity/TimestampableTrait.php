<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
// @TODO : Faire une analyse de l'erreur lors de la sauvegarde d'un message
// [Semantical Error] The annotation "@Gedmo\Timestampable" in property App\Entity\Message::$createdAt was never imported. Did you maybe forget to add a "use" statement for this annotation?
use Gedmo\Timestampable\Traits\TimestampableEntity;

trait TimestampableTrait
{
    use TimestampableEntity;

    #[ORM\PreUpdate]
    #[ORM\PrePersist]
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime());
        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}
