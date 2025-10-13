<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Section;

class SectionFixtures extends Fixture
{
    public const SEC_ONE_REFERENCE = 'sec1';
    public const SEC_TWO_REFERENCE = 'sec2';

    public function load(ObjectManager $manager): void
    {
        $section1 = new Section();

        $section1->setTitleJson(['fr' => 'Section']);

        $section2 = new Section();

        $section2->setTitleJson(['fr' => 'Partie']);

        $manager->persist($section1);
        $manager->persist($section2);
        $manager->flush();

        $this->addReference(self::SEC_ONE_REFERENCE, $section1);
        $this->addReference(self::SEC_TWO_REFERENCE, $section2);
    }
}
