<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotTuesdayValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\NotTuesday */

        if($bookingDate -> format('w')==2) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
