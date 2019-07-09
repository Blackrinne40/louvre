<?php


namespace App\Tests;

use App\Entity\Booking;
use App\Entity\Ticket;
use App\Services\PriceCalculator;
use DateTime;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    /**
     * @dataProvider datasForBookingPrice
     * @throws \Exception
     */
    public function testComputeBookingPrice($birthdate,$visitDate, $visitType, $reductPrice, $expectedPrice)
    {
        $priceCalculator = new PriceCalculator();
        $booking = new Booking();
        $booking->setVisitType($visitType);
        $booking->setVisitDate(new DateTime($visitDate));
        $ticket = new Ticket();
        $ticket->setBirthdate(new DateTime($birthdate));
        $ticket->setReductPrice($reductPrice);

        $booking->addTicket($ticket);

        $this->assertEquals($priceCalculator->computeBookingPrice($booking),$expectedPrice);
    }

    /**
     * @return array
     */
    public function datasForBookingPrice()
    {
        return [
            ['1950-01-01', '2020-01-01',1,false,12],// 70 years, Full day
            ['1990-01-01', '2020-01-01',1,false,16],// 30 years, Full day
            ['2009-01-01', '2020-01-01',1,false,8],// 11 years, Full day
            ['2017-01-01', '2020-01-01',1,false,0],// 3 years, Full day
            ['1950-01-01', '2020-01-01',0,false,6],// 70 years, Half day
            ['1990-01-01', '2020-01-01',0,false,8],// 30 years, Half day
            ['2009-01-01', '2020-01-01',0,false,4],// 11 years, Half day
            ['2017-01-01', '2020-01-01',0,false,0],// 3 years, Half day
            ['1990-01-01', '2020-01-01',1,true,10],// 30 years, Full day, Reduced price
            ['1990-01-01', '2020-01-01',0,true,5],// 30 years, Half day, Reduced price
        ];
    }
}