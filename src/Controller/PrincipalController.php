<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/message/{departement}&{sexe}", name="message")
     */
    public function message(string $departement, string $sexe) {
        $date = date('l jS \of F Y h:i:s A');
        if($sexe != "garçon" and $sexe != "fille") {
            $sexe = "sexe inconnu !";
        }
        return $this->render('principal/message.html.twig', array(
                        "departement" => $departement,
                        "sexe" => $sexe,
                        "date" => $date
        ));
    }
}