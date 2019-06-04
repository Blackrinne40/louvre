<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotHolidaysValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\NotHolidays */
        if($bookingDate -> format('m-d')== '12-25')
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
        elseif ($bookingDate -> format('m-d')== '11-01')
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
        elseif ($bookingDate -> format('m-d')== '05-01')
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
        else{ return;}
    }
}
