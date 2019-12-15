<?php

namespace App\Validator\Constraints;

use App\Dto\OrderDto;
use App\Services\Order\ParserInformation;
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
        $value->orderInformation = (new ParserInformation())->stringToArray($value->orderInformation);
        var_dump($value->orderInformation);exit(1);
        if ($value->orderInformation["order_information"] == "") {
            return;
        }

        if (!(
            $value->city &&
            $value->house &&
            $value->podezd &&
            $value->apartment &&
            $value->floor
        )) {
            $this->context->buildViolation($constraint->message)
                ->atPath("city")
                ->addViolation();
        }
    }
}