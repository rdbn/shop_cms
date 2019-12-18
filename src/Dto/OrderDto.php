<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class OrderDto
{
    const STATUS = [
        "process" => 1,
        "end" => 2,
        "in_work" => 3,
        "delete" => 4,
        "clone" => 5,
    ];

    /**
     * @var int
     */
    public $id;

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
     * @var string
     */
    public $tel;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $house;

    /**
     * @var string
     */
    public $podezd;

    /**
     * @var string
     */
    public $floor;

    /**
     * @var string
     */
    public $apartment;

    /**
     * @var string
     */
    public $domofon;

    public $status = self::STATUS["process"];

    /**
     * @var int
     */
    public $sales;

    /**
     * @var string
     */
    public $message;

    /**
     * @var int
     */
    public $countPersons;

    /**
     * @var float
     */
    public $surrender;

    /**
     * @var string
     */
    public $courierName;

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
//        $metadata->addConstraint(new AddressOrder());
        $metadata->addPropertyConstraint("orderUsername", new Assert\NotBlank());
        $metadata->addPropertyConstraint("orderInformation", new Assert\NotBlank());
        $metadata->addPropertyConstraint("tel", new Assert\NotBlank());
    }
}