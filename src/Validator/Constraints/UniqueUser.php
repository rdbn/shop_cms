<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueUser extends Constraint
{
    public $message = 'This username is used!';

    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return \get_class($this).'Validator';
    }

    /**
     * @return string
     */
    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}