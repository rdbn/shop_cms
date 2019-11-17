<?php

namespace App\Dto;

use App\Validator\Constraints\UniqueOrder;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class OrderDto
{
    /**
     * @var int
     */
    public $orderNumber;

    /**
     * @var float
     */
    public $price;

    /**
     * @var int
     */
    public $countProduct;

    /**
     * @var string
     */
    public $orderDate;

    /**
     * @var string
     */
    public $orderUsername;

    /**
     * @var string
     */
    public $orderInformation;

    /**
     * OrderCreate constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->orderDate = (new \DateTime())->format("Y-m-d H:i:s");
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint("orderNumber", new Assert\NotBlank());
        $metadata->addPropertyConstraint("orderNumber", new UniqueOrder());
        $metadata->addPropertyConstraint("price", new Assert\NotBlank());
        $metadata->addPropertyConstraint("countProduct", new Assert\NotBlank());
        $metadata->addPropertyConstraint("orderUsername", new Assert\NotBlank());
        $metadata->addPropertyConstraint("orderInformation", new Assert\NotBlank());
    }
}