<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use SYmfony\Component\Httpfoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
   
    #[Route('/')]
    public function home() : Response
    {
	return new Response(content:'Bienvenue sur votre accueil') ;
     }
}