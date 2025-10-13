<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Page;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $page1 = new Page();

        $page1->setTitleJson(['fr' => 'testPage1']);
        $page1->setContentJson(['fr' => 'content1']);
        $page1->setCategory($this->getReference(CategoryFixtures::CAT_ONE_REFERENCE, Category::class));

        $page2 = new Page();

        $page2->setTitleJson(['fr' => 'testPage2']);
        $page2->setContentJson(['fr' => 'content2']);
        $page2->setCategory($this->getReference(CategoryFixtures::CAT_ONE_REFERENCE, Category::class));

        $page3 = new Page();

        $page3->setTitleJson(['fr' => 'testPage3']);
        $page3->setContentJson(['fr' => 'content3']);
        $page3->setCategory($this->getReference(CategoryFixtures::CAT_TWO_REFERENCE, Category::class));

        $manager->persist($page1);
        $manager->persist($page2);
        $manager->persist($page3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }
}
