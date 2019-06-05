<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PMTodayValidator extends ConstraintValidator
{
    public function validate($booking, Constraint $constraint)
    {
        $date=new \DateTime();
        dump($date);
        /* @var $constraint PMToday */

        if (($date->format('Y-m-d') == date('Y-m-d'))
        && ($booking->getVisitType()==1)
        && (date('H') >= '14'))
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('visit_type')
                ->addViolation();
        }
        else {return;}

    }
}
