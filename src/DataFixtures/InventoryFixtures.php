<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Inventory;
use App\Entity\Category;

class InventoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $inventory = new Inventory();


        $inventory->setCategory($this->getReference(CategoryFixtures::CAT_TWO_REFERENCE, Category::class));

        $manager->persist($inventory);
        $manager->flush();
    }
}
