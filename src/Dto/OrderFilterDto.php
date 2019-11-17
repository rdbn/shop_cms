<?php

namespace App\Dto;


class OrderFilterDto
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $price;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $limit = 20;
}