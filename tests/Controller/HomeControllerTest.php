<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class HomeControllerTest extends WebTestCase
{
    public function testUserCanGetToIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testUserCanGoToProfile(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('exemple123@blabla.fr ');

        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/my-profile');

        $this->assertResponseIsSuccessful();
    }
}
