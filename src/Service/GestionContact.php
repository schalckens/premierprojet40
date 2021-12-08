<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;

class GestionContact {
    
    private ManagerRegistry $managerRegistry;
    public function __construct(ManagerRegistry $managerRegistry) {
        $this->managerRegistry = $managerRegistry;
    }
    public function creerContact(Contact $contact) : void {
        $contact->setDatePremierContact(new \DateTime());
        $em= $this->managerRegistry->getManager();
        $em->persist($contact);
        $em->flush();
    }
}
