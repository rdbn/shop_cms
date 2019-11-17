<?php

namespace App\Validator\Constraints;

use App\Dto\OrderDto;
use App\Repository\OrderRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueOrderValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param OrderDto $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     * @throws DBALException
     */
    public function validate($value, Constraint $constraint)
    {
        $order = (new OrderRepository())->findOrdersByOrderNumber($value->orderNumber);
        if (false != $order && $value->id != $order) {
            $this->context->buildViolation($constraint->message)
                ->atPath("orderNumber")
                ->addViolation();
        }
    }
}