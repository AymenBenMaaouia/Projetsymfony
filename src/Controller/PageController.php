<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/codecraker', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('jobe/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
    #[Route('/test/{classe}')]
    function Test($classe){
        // return new Response("<h1>Bonjour <i>".$classe."</i></h1>");
        return $this->render('page/test.html.twig',[
            'c'=>$classe
        ]);
    }

    #[Route('/dash', name: 'admin')]
    public function dash(): Response
    {
        return $this->render('dash/index.html.twig');
    }


}
