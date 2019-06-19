<?php

namespace App\Validator;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Services\TotalTicketsDayCalculator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @property TotalTicketsDayCalculator totalTicketsDayCalculator
 */
class MaxQuantityTicketsValidator extends ConstraintValidator
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * MaxQuantityTicketsValidator constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param mixed $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        /** @var Booking $booking */
        $totalTicketsDay= $this->bookingRepository->countTicketPerDay($booking->getVisitDate());
        $ticketsQuantityAvailable = Booking::MAX_CAPACITY - $totalTicketsDay;
        /* @var $constraint MaxQuantityTickets */

        if (($booking->getNumberTickets() + $totalTicketsDay )>Booking::MAX_CAPACITY)
        {
           $this->context->buildViolation($constraint->message)
            ->setParameter('{{ ticketsQuantityAvailable }}', $ticketsQuantityAvailable)
               ->atPath('number_tickets')
            ->addViolation();
        }
    }
}
