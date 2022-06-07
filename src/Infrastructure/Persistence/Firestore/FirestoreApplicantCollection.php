<?php

declare(strict_types=1);

namespace SymfonyCraft\Puddle\Infrastructure\Persistence\Firestore;

use SymfonyCraft\Puddle\Domain\Applicant;
use SymfonyCraft\Puddle\Domain\ApplicantCollection;
use SymfonyCraft\Puddle\Domain\VO\Email;

final class FirestoreApplicantCollection implements ApplicantCollection
{

    private const COLLECTION_NAME = 'applicant';

    public function __construct(
        private FirestoreAppCollection $firestoreAppCollection,
    ) {

    }

    public function find(Email $email): ?Applicant {
        $applicantFirestoreCollection = $this->firestoreAppCollection->getCollection(self::COLLECTION_NAME);

        $applicantFirestoreSnapshot = $applicantFirestoreCollection->document($email->get())->snapshot()->data();

        return Applicant::fromSnapshot($applicantFirestoreSnapshot)
     }

    public function add(Applicant $applicant): void { 

        $applicantFirestoreCollection = $this->firestoreAppCollection->getCollection(self::COLLECTION_NAME);

        $applicantFirestoreDocument = $applicantFirestoreCollection->document($applicant->toSnapshot()['email']);

        $applicantFirestoreDocument->set($applicant->toSnapshot());
    }
    
}
