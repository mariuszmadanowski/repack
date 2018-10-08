<?php

namespace App\Domain\Model;

use App\Domain\Model\ReceivingConveyance;
use App\Domain\Model\Box;
use App\Domain\ValueObject\Weight;

/**
 * @model
 */
class DeliveryTruck extends ReceivingConveyance
{
    public function __construct(Weight $weight)
    {
        parent::__construct(Box::class, $weight);
    }
}
