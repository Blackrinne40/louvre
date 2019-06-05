<?php


namespace App\Services;



use App\Repository\BookingRepository;

/**
 * @property BookingRepository bookingRepository
 */
class TotalTicketsDayCalculator
{
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function totalTicketsDayCalculator($bookingDate)
    {
        $bookingSelectedDate= $this->bookingRepository->findBy(['booking_date'=>$bookingDate]);
        $totalTicketsSelectedDay =0;

        if ($bookingSelectedDate !== null)
        {
            foreach ($bookingSelectedDate as $booking)
            {
                $ticketsQuantityPerBooking = $booking->getNumberTickets();

                $totalTicketsSelectedDay += $ticketsQuantityPerBooking;
            }
        }
        return $totalTicketsSelectedDay;

    }



}