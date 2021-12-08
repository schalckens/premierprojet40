<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\ContactType;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\GestionContact;


class ContactController extends AbstractController
{
    
    /*
    public function new(): Response
    {
        // creates a contact object and initializes some data for this example
        $contact = new Contact();
        $contact->setTitre("M");
        $contact->setNom("Roche");
        $contact->setPrenom("Benoit");
        $contact->setMail("alors@gmail.com");
        $contact->setTelephone("0602020202");
        $contact->setDateHeureContact(date_create("now"));
                
        

        $form = $this->createForm(ContactType::class, $contact)
                ->add('save', SubmitType::class,  ['label' => 'Create']);
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
     * 
     */
    
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     */
    public function demandeContact(Request $request, GestionContact $gestionContact) {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
                ->add('titre', ChoiceType::class, array(
                    'choices' => array(
                        'Monsieur' => 'M',
                        'Madame' => 'F',
                    ), 'multiple' => false,
                    'expanded' => true,
                ))
                ->add('nom', TextType::class,
                       array(
                           'label' => 'Nom : ',
                           'required' => true,
                           // 'data' => $builder->getAttribute("nom", "aaa"),
                       ))
                ->add('prenom', TextType::class,
                       array(
                           'label' => 'Prénom : ',
                           'required' => true,
                       ))
                ->add('mail', EmailType::class,
                        array(
                            'label' => 'Mail : ',
                            'required' => true,
                        ))
                ->add('telephone', TelType::class,
                        array(
                            'label' => 'Téléphone : ',
                            'required' => true,
                        ))
                ->add('Envoyer', SubmitType::class)
                ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /*
             * $contact = $form->getData();
             * $contact->setDatePremierContact(new \DateTime());
             * $em = $doctrine->getManager();
             * $em->persist($contact);
             * $em->flush();
             */
            $gestionContact->creerContact($contact);
            return $this->redirectToRoute("principal");
        }
        
        return $this->render('contact/contact.html.twig',
                ['formContact' => $form->createView(),
                 'titre' => 'Formulaire de contact',
                ]);
                
                
    }
    
}
