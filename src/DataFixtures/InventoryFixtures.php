<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Inventory;
use App\Entity\Category;

class InventoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $inventory = new Inventory();


        $inventory->setCategory($this->getReference(CategoryFixtures::CAT_THREE_REFERENCE, Category::class));

        $manager->persist($inventory);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }
}
