<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibroController extends AbstractController
{
    #[Route('/libro', name: 'app_libro')]
    public function index(): Response
    {
        return $this->render('libro/index.html.twig', [
            'controller_name' => 'LibroController',
        ]);
    }
}
