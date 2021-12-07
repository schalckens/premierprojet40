<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;


class ContactController extends AbstractController
{
    
    /**
     * @Route("/contact")
     * @return Response
     */
    public function new(): Response
    {
        // creates a contact object and initializes some data for this example
        $contact = new Contact();
        $contact->setNom("Roche");
        $contact->setPrenom("Benoit");
        $contact->setMail("alors@gmail.com");
        $contact->setTelephone("0202020202");
        $contact->setDateHeureContact(date_create("now"));
                
        

        $form = $this->createForm(ContactType::class, $contact)
                ->add('save', SubmitType::class,  ['label' => 'Create']);
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
