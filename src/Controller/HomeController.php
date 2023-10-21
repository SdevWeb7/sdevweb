<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index() : Response
    {
       return $this->render('home/index.html.twig');
    }

    #[Route('/react-api/{reactRouting}', name: 'app_react', defaults: ['reactRouting' => null])]
    public function react() : Response
    {
        return $this->render('home/react.html.twig');
    }

}
