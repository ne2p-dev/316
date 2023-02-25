<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('Home/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }
}
