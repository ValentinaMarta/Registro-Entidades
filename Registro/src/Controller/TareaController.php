<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TareaController extends AbstractController
{
    #[Route('/tarea', name: 'app_tarea')]
    public function index(): Response
    {
        return $this->render('tarea/index.html.twig', [
            'controller_name' => 'TareaController',
        ]);
    }
}
