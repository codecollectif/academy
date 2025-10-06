<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\PageRepository;
use App\Entity\Page;
use App\Entity\Category;
use App\Controller\HomeController;
use Doctrine\ORM\EntityManagerInterface;

class HomeControllerTest extends WebTestCase
{
    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $manager = $container->get(EntityManagerInterface::class);

        $category = new Category();

        $page1 = new Page();

        $page1->setTitleJson(['fr' => 'testPage1']);
        $page1->setCategory($category);

        $page2 = new Page();

        $page2->setTitleJson(['fr' => 'testPage2']);
        $page2->setCategory($category);

        $manager->persist($category);
        $manager->persist($page1);
        $manager->persist($page2);

        $manager->flush();
        $pageRepository = $this->createMock(PageRepository::class);
        $pageRepository->expects(self::once())
            ->method('findBy')
            ->willReturn([
                $page1,
                $page2
            ])
        ;

        $container->set(PageRepository::class, $pageRepository);

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
