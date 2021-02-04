<?php

namespace App\Controller;

use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param RealisationRepository $realisationRepository
     * @return Response
     */
    public function index(RealisationRepository $realisationRepository): Response
    {
        $realisations = $realisationRepository->findAll();
        return $this->render('home.html.twig', [
            'realisations' => $realisations
        ]);
    }
}