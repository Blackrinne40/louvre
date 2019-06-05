<?php

namespace App\Validator;

use App\Services\TotalTicketsDayCalculator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @property TotalTicketsDayCalculator totalTicketsDayCalculator
 */
class MaxQuantityTicketsValidator extends ConstraintValidator
{
    /**
     * MaxQuantityTicketsValidator constructor.
     * @param TotalTicketsDayCalculator $totalTicketsDayCalculator
     */
    public function __construct(TotalTicketsDayCalculator $totalTicketsDayCalculator)
    {
        $this->totalTicketsDayCalculator = $totalTicketsDayCalculator;
    }

    /**
     * @param mixed $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        $totalTicketsDay= $this->totalTicketsDayCalculator->totalTicketsDayCalculator($booking->getBookingDate());
        $ticketsQuantityAvailable = 1000 - $totalTicketsDay;
        /* @var $constraint MaxQuantityTickets */

        if (($booking->getNumberTickets() + $totalTicketsDay )>1000)
        {
           $this->context->buildViolation($constraint->message)
            ->setParameter('{{ ticketsQuantityAvailable }}', $ticketsQuantityAvailable)
               ->atPath('number_tickets')
            ->addViolation();
        }
        else {return;}
    }
}
