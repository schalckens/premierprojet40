<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class GestionContact {
    
    private ManagerRegistry $managerRegistry;
    private MailerInterface $mailer;
    
    public function __construct(ManagerRegistry $managerRegistry, MailerInterface $mailer) {
        $this->managerRegistry = $managerRegistry;
        $this->mailer = $mailer;
    }
    public function creerContact(Contact $contact) : void {
        $contact->setDatePremierContact(new \DateTime());
        $em= $this->managerRegistry->getManager();
        $em->persist($contact);
        $em->flush();
    }
    
    public function envoiMailContact(Contact $contact) {
        $email = (new  TemplatedEmail())
                ->from(new Address('contact@valentineschalckens.fr','Contact Symfony'))
                ->to($contact->getMail())
                ->subject('Demande de renseignement')
                ->text('Bonjour')
                ->attachFromPath('assets/documents/presentation.pdf', 'Présentation')
                ->htmlTemplate('mails/mail.html.twig')
                ->context ([
                    'contact' => $contact,
                ]);
        $this->mailer->send($email);
    }
}
