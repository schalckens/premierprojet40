<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employe;
use App\Entity\Lieu;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\Bundle\DoctrineBundle\Registry;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => "Symfony, c'est super",
        ]);
    }
    /**
     * 
     * @Route("/welcome/{nom}", name="welcome")
     */
    public function welcome(string $nom) {
        return $this->render('principal/welcome.html.twig', array(
                        "nom" => $nom
        ));
    }
    
    /**
     * 
     * @Route("/message/{departement}/{sexe}", name="message")
     */
    public function message(int $departement, string $sexe) {
        $date = date('l jS \of F Y h:i:s');
        
        if ($sexe == 'F') {
            $sexe = 'une fille';
        } 
        elseif ($sexe == 'M') {
            $sexe = 'un garçon';
        } else {
            $sexe = ' de sexe inconnu';
        }
        
       
        return $this->render('principal/message.html.twig', array(
                        "departement" => $departement,
                        "sexe" => $sexe,
                        "date" => $date
        ));
    }
    
    /**
     * 
     * @Route("/employes", name="employes")
     * @param ManagerRegistry $doctrine
     */
    public function afficheEmployes(ManagerRegistry $doctrine) : Response {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
    /**
     * 
     * @Route("/employe/{id}", name="unEmploye", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmploye(ManagerRegistry $doctrine, int $id) : Response {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unEmploye.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/employetout/{id}", name="employetout", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmployeTout(ManagerRegistry $doctrine, int $id) {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unemployetout.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/lieu/{id}", name="unlieu", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnLieu(ManagerRegistry $doctrine, int $id) {
        $lieu = $doctrine->getRepository(Lieu::class)->find($id);
        $titre = "Lieu n° " . $id;
        return $this->render('principal/unlieu.html.twig', compact('titre','lieu'));
    }
    
    /**
     * @Route("/employe/modif/salaire/{id}/{salaire}", name="employeModificationColonne", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @param int $salaire
     */
    public function modifierColonne(ManagerRegistry $doctrine, int $id, float $salaire) {
        $em = $doctrine->getManager(); //entityManager
        $employe = $em->getRepository(Employe::class)->find($id);
        
        if ($employe) {
            $employe->setSalaire($salaire);
        }
        else {
            throw new Exception;
        }
        $em->flush();
        //$doctrine->persist($employe);
        return $this->redirectToRoute("unEmploye", [
            'id' => $id
        ]);
    }
    
    /**
     * @Route("/employe/crea"n name="creaEmploye")
     * @param Managerregistry $doctrine
     */
    public function creerEmploye(Managerregistry $doctrine){
        $em = $doctrine->getManager();
        $employe = new Employe();
        $employe->setNom("Kerebel");
        $employe->setSalaire(100000.00);
        $employe->setLieu($lieu);
    }
}