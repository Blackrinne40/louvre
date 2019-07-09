<?php


namespace App\Tests;

use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url,$statusCode)
    {
        $client = self::createClient();

//        $session = $client->getContainer()->get('session');
//        $session->set('booking', new Booking());
        $client->request('GET', $url);

        $this->assertSame($statusCode,$client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        yield ['/',302];
        yield ['/en/',200];
        yield ['/fr/',200];
        yield ['/fr/booking',200];
        yield ['/fr/ticket',404];
        yield ['/fr/order',404];
        yield ['/fr/confirmation',404];
    }



}