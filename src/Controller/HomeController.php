<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PageRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'pages' => $pageRepository->findBy(
                array(),
                array('id' => 'DESC'),
                10
            ),
        ]);
    }

    #[Route('/my-profile', name: 'app_my_profile')]
    public function profile(): Response
    {
        return $this->render('home/profile.html.twig');
    }
}
