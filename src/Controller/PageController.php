<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/page')]
final class PageController extends AbstractController
{
    #[Route(name: 'app_page_index', methods: ['GET'])]
    public function index(
        PageRepository $pageRepository,
        CategoryRepository $categoryRepository,
        Request $request
    ): Response {
        $pagesToShow = $pageRepository->findAll();
        if ($request->query->has("q") && $request->query->get("q") != '') {
            $pagesToShow = $pageRepository->findByResearch($request->query->get("q"));
        }
        if ($request->query->has("category") && $request->query->get("category") != '') {
                $pagesToShow = $pageRepository->findBy(['category' => $request->query->get("category")]);
        }
        if (
            $request->query->has("q") &&
            $request->query->get("q") != '' &&
            $request->query->has("category") &&
            $request->query->get("category") != ''
        ) {
                $pagesToShow = $pageRepository->findByResearchAndCategory(
                    $request->query->get("q"),
                    $request->query->get("category")
                );
        }

        $categories = $categoryRepository->findAll();

        return $this->render('page/index.html.twig', [
            'pages' => $pagesToShow,
            'q' => $request->query->get("q"),
            'categories' => $categories,
            'category' => $request->query->get("category")
        ]);
    }

    #[Route('/new', name: 'app_page_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('page/new.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_page_show', methods: ['GET'])]
    public function show(Page $page): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Page $page, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('page/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_page_delete', methods: ['POST'])]
    public function delete(Request $request, Page $page, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete' . $page->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($page);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
    }
}
