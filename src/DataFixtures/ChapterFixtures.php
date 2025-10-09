<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Chapter;
use App\Entity\Category;

class ChapterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $chapter = new Chapter();


        $chapter->setCategory($this->getReference(CategoryFixtures::CAT_ONE_REFERENCE, Category::class));

        $manager->persist($chapter);
        $manager->flush();
    }
}
