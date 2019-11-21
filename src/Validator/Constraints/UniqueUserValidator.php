<?php

namespace App\Validator\Constraints;

use App\Dto\OrderDto;
use App\Dto\RegistrationDto;
use App\Repository\UserRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUserValidator extends ConstraintValidator
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UniqueUserValidator constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param RegistrationDto $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     * @throws DBALException
     */
    public function validate($value, Constraint $constraint)
    {
        $user = $this->userRepository->findUserByUsername($value->username);
        if (false != $user) {
            $this->context->buildViolation($constraint->message)
                ->atPath("username")
                ->addViolation();
        }
    }
}