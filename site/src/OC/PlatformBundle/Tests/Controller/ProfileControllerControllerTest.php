<?php

namespace OC\PlatformBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerControllerTest extends WebTestCase
{
    public function testProfile()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profile');
    }

}
