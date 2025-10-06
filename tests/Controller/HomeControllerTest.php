<?php

namespace App\Tests\Controller;

use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\PageRepository;
use App\Entity\Page;
use App\Entity\Category;
use App\Controller\HomeController;

class HomeControllerTest extends WebTestCase
{
    public function setId(object $entity, int $id): void
    {
        $reflectionClass = new ReflectionClass($entity);
        $idProperty = $reflectionClass->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);
    }

    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $category = new Category();

        $page1 = new Page();

        $reflectionClass = new ReflectionClass($page1);

        $page1->setTitleJson(['fr' => 'testPage1']);
        $page1->setCategory($category);
        $this->setId($page1, 1);

        $page2 = new Page();

        $page2->setTitleJson(['fr' => 'testPage2']);
        $page2->setCategory($category);
        $this->setId($page2, 1);

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
