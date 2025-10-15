<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\ChapterRepository;
use App\Entity\Chapter;
use App\Entity\Category;
use App\Entity\Section;

class HomeControllerTest extends WebTestCase
{
    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();

        $this->mockChapterRepository();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testUserCanGetToFAQ(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/faq');

        $this->assertResponseIsSuccessful();
    }

    private function mockChapterRepository(): void
    {
        $chapters = [];

        for ($i = 1; $i <= 2; $i++) {
            $category = new Category();
            $section = new Section();

            $category->setTitleJson(['fr' => 'testChapter' . $i]);
            $section->setTitleJson(['fr' => 'testSection' . $i]);
            $chapter = new class ($i) extends Chapter {
                public function __construct(private int $i)
                {
                }

                public function getId(): int
                {
                    return $this->i;
                }
            };

            $chapter->setCategory($category);
            $chapter->setSection($section);

            $chapters[] = $chapter;
        }

        $chapterRepository = $this->createMock(ChapterRepository::class);
        $chapterRepository->expects(self::once())
            ->method('findBy')
            ->willReturn($chapters)
        ;

        static::getContainer()->set(ChapterRepository::class, $chapterRepository);
    }
}
