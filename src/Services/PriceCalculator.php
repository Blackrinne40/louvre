<?php


namespace App\Services;


use App\Entity\Booking;
use Exception;

class PriceCalculator
{
    /**
     * @param Booking $booking
     * @return int
     */
    public function computeBookingPrice(Booking $booking)
    {
        $total = 0;
        foreach ($booking->getTickets() as $ticket) {
            $age = $ticket->getBirthdate()->diff($booking->getVisitDate())->y;
            if ($age < Booking::AGE_BABY) {
                $price = Booking::PRICE_BABY;
            } elseif ($age < Booking::AGE_CHILD) {
                $price = Booking::PRICE_CHILD;
            } //Normal price Full-day
            elseif ($age < Booking::AGE_SENIOR) {
                $price = Booking::PRICE_ADULT;
            } //Senior price Full-day
            else {
                $price = Booking::PRICE_SENIOR;
            }

            if ($ticket->getReductPrice() && $price > Booking::PRICE_REDUCT) {
                $price = Booking::PRICE_REDUCT;
            }

            if ($booking->getVisitType() == Booking::TYPE_HALF_DAY) {
                $price = $price * Booking::COEF_HALF_DAY;
            }

            $ticket->setPrice($price);
            $total = $total + $price;
        }


        $booking->setTotalPrice($total);
        return $total;

    }
}