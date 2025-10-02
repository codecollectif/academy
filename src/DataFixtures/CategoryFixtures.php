<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CAT_ONE_REFERENCE = 'cat1';
    public const CAT_TWO_REFERENCE = 'cat2';

    public function load(ObjectManager $manager): void
    {
        $cat1 = new Category();

        $cat1->setTitleJson(['fr' => 'testing']);

        $cat2 = new Category();

        $cat2->setTitleJson(['fr' => 'antesting']);

        $manager->persist($cat1);
        $manager->persist($cat2);

        $manager->flush();

        $this->addReference(self::CAT_ONE_REFERENCE, $cat1);
        $this->addReference(self::CAT_TWO_REFERENCE, $cat2);
    }
}
