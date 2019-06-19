<?php

namespace App\Validator;

use App\Entity\Booking;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PMTodayValidator extends ConstraintValidator
{
    public function validate($booking, Constraint $constraint)
    {
        /* @var $constraint PMToday */

        if (($booking->getVisitDate()->format('Y-m-d') == date('Y-m-d'))
        && ($booking->getVisitType()== Booking::TYPE_DAY)
        && (date('H') >= '14'))
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('visit_type')
                ->addViolation();
        }

    }
}
