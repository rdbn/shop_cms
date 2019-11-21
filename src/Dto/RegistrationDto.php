<?php

namespace App\Dto;

use App\Validator\Constraints\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class RegistrationDto
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new UniqueUser());
        $metadata->addPropertyConstraint("username", new Assert\NotBlank());
        $metadata->addPropertyConstraint("password", new Assert\NotBlank());
    }
}