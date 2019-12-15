<?php

namespace App\Dto;


class OrderFilterDto
{
    /**
     * @var string
     */
    public $tel;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $limit = 20;
}