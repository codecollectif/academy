<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChapterRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ChapterRepository $chapterRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'chapters' => $chapterRepository->findBy(
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

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }
}
