<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\PageRepository;
use App\Entity\Page;
use App\Entity\Category;
use App\Controller\HomeController;

class HomeControllerTest extends WebTestCase
{
    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $page1 = new Page();

        $page1->setTitleJson(['fr' => 'testPage1']);

        $page2 = new Page();

        $page2->setTitleJson(['fr' => 'testPage2']);

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
