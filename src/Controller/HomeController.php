<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChapterRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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

    #[Route('/contact/email', name: 'app_contact_email', methods: ['POST'])]
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        $email = (new Email())
            ->from($this->getUser()->getEmail())
            ->to($request->request->get('email'))
            ->subject('Email')
            ->text($request->request->get('content'));

        $mailer->send($email);
        return $this->redirectToRoute('app_home');
    }
}
