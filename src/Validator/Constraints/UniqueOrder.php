<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueOrder extends Constraint
{
    public $message = 'This order number is used!';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}