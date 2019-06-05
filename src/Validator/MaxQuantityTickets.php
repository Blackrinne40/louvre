<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxQuantityTickets extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Nombre de billets encore disponibles à la réservation pour cette date: {{ ticketsQuantityAvailable }}. Vous ne pouvez pas dépasser cette quantité';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
