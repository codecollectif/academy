<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Chapter;
use App\Entity\Category;
use App\Entity\Section;

class ChapterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $chapter1 = new Chapter();

        $chapter1->setSection($this->getReference(SectionFixtures::SEC_ONE_REFERENCE, Section::class));
        $chapter1->setCategory($this->getReference(CategoryFixtures::CAT_ONE_REFERENCE, Category::class));

        $chapter2 = new Chapter();

        $chapter2->setSection($this->getReference(SectionFixtures::SEC_TWO_REFERENCE, Section::class));
        $chapter2->setCategory($this->getReference(CategoryFixtures::CAT_TWO_REFERENCE, Category::class));
        $chapter2->addLink($chapter1);

        $manager->persist($chapter1);
        $manager->persist($chapter2);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SectionFixtures::class,
            CategoryFixtures::class
        ];
    }
}
