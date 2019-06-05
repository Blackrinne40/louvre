<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PMToday extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = "Il n'est pas possible de réserver un billet Journée pour le jour-même après 14h00.";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
