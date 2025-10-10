<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\ChapterRepository;
use App\Entity\Chapter;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ChapterControllerTest extends WebTestCase
{
    private const ID = 1;

    public function testIfDeleteChapterIsSuccessful(): void
    {
        $client = static::createClient();

        $this->mockChapterRepository();

        $crawler = $client->request('POST', "/chapter/" . self::ID);

        $this->assertResponseRedirects();
    }

    private function mockChapterRepository(): void
    {
        $category = new Category();

        $category->setTitleJson(['fr' => 'testChapter']);
        $chapter = new class (self::ID) extends Chapter {
            public function __construct(private int $identifier)
            {
                $this->identifier = $identifier;
            }

            public function getId(): int
            {
                    return $this->identifier;
            }
        };
        $chapter->setCategory($category);

        $chapterRepository = $this->createMock(ChapterRepository::class);

        static::getContainer()->set(ChapterRepository::class, $chapterRepository);

        $chapterRepository->expects(self::once())
            ->method('find')
            ->willReturn($chapter)
        ;
    }
}
