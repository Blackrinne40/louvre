<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/en/');
        //$this->assertSelectorTextContains('html h1.title', 'Hello World');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html a.btn:contains("Booking")')->count()
        );
    }

}