<?php

namespace App\Domain\Model;

use App\Domain\Model\DeliveringConveyance;
use App\Domain\Model\Box;

/**
 * @model
 */
class Truck extends DeliveringConveyance
{
    public function __construct(int $quantity)
    {
        parent::__construct(Box::class, $quantity);
    }
}
