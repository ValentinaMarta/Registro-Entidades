<?php

namespace App\Controller;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    const ELEMENTOS_POR_PAGINA=10;
    #[Route("/{pagina}", name: "index", defaults:["pagina" => 1], requirements:["pagina"=>"\d+"], methods: ['GET'])]

    public function index(int $pagina,LibroRepository $libroRepository): Response
    {
      
        return $this->render('index/Index.html.twig', [
            'libros' => $libroRepository->buscarTodas($pagina, self::ELEMENTOS_POR_PAGINA),
            'pagina'=> $pagina,
        ]);
    }
}
