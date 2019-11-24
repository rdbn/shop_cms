<?php

namespace App\Validator\Constraints;

use App\Dto\OrderDto;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AddressOrderValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param OrderDto $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!(
            $value->city &&
            $value->house &&
            $value->podezd &&
            $value->apartment &&
            $value->floor &&
            $value->domofon
        )) {
            $this->context->buildViolation($constraint->message)
                ->atPath("city")
                ->addViolation();
        }
    }
}