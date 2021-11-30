<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of PremierController
 *
 * @author valentine.schalckens
 */
class PremierController {
    
    /**
     * 
     * @Route("/index", name="index")
     */
    public function index() {
        return new Response($content = 'Bonjour mon premier contrôleur');
    }
    
}
