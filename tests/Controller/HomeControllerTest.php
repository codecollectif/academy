<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\PageRepository;
use App\Entity\Page;

class HomeControllerTest extends WebTestCase
{
    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();

        $this->mockPageRepository();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testUserCanGetToFAQ(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/faq');

        $this->assertResponseIsSuccessful();
    }

    private function mockPageRepository(): void
    {
        $pages = [];

        for ($i = 1; $i <= 2; $i++) {
            $page = new class ($i) extends Page {
                public function __construct(private int $i)
                {
                }

                public function getId(): int
                {
                    return $this->i;
                }
            };

            $page->setTitleJson(['fr' => 'testPage' . $i]);

            $pages[] = $page;
        }

        $pageRepository = $this->createMock(PageRepository::class);
        $pageRepository->expects(self::once())
            ->method('findBy')
            ->willReturn($pages)
        ;

        static::getContainer()->set(PageRepository::class, $pageRepository);
    }
}
