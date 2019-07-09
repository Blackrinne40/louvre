<?php


namespace App\Tests;


use App\Entity\Booking;
use App\Entity\Ticket;
use App\Manager\BookingManager;
use DateTime;
use Exception;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{

    /**
     * @return Generator
     */
    public function datasForBooking()
    {
        yield [1, "2019-08-05", "p@p.fr","p@p.fr",2];
        
        yield [1, "2019-08-05", "p@p.fr","p@p.fr",2];
    }

    /**
     * @dataProvider datasForBooking
     * @param $visitType
     * @param $visitDate
     * @param $emailFirst
     * @param $emailSecond
     * @param $numberTickets
     */
    public function testBooking($visitType, $visitDate, $emailFirst, $emailSecond,  $numberTickets)
    {
        $client = static::createClient();



        $crawler = $client->request('GET', '/fr/booking');

        $formBooking = $crawler->selectButton('Poursuivre la commande >')->form();
        $formBooking['booking[number_tickets]'] = $numberTickets;
        $formBooking['booking[visit_type]'] = $visitType;
        $formBooking['booking[visit_date]'] = $visitDate;
        $formBooking['booking[email][first]'] = $emailFirst;
        $formBooking['booking[email][second]'] = $emailSecond;

        $client->submit($formBooking);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
    }

    public function datasForTicket()
    {
        return [
            ["Paul", "Lacoste", "05/08/1989", "FR", 1],
            ["Virginie", "Lacoste", "05/08/2015", "FR", 1]
        ];
    }

    /**
     * @dataProvider datasForTicket
     * @param $firstname
     * @param $lastname
     * @param $birthdate
     * @param $country
     * @param $reductPrice
     * @throws Exception
     */
    public function testTicket($firstname, $lastname, $birthdate, $country, $reductPrice)
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');
        $booking = new Booking();
        $booking->setEmail('p@p.fr');
        $booking->setVisitDate(new DateTime ("2020-02-01"));
        $booking->setNumberTickets(1);
        $booking->setVisitType(Booking::TYPE_DAY);

        $booking->addTicket(new Ticket());
        $session->set(BookingManager::SESSION_ID, $booking);



        $crawler = $client->request('GET', '/fr/ticket');

        $formTicket = $crawler->selectButton('Récapitulatif de commande')->form();

            $formTicket['booking_tickets[tickets][0][firstname]']= $firstname;
            $formTicket['booking_tickets[tickets][0][lastname]']= $lastname;
            $formTicket['booking_tickets[tickets][0][birthdate]']= $birthdate;
            $formTicket['booking_tickets[tickets][0][country]']= $country;
            $formTicket['booking_tickets[tickets][0][reductPrice]']= $reductPrice;


        $client->submit($formTicket);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
    }


}