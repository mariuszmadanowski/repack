<?php

namespace App\Domain\Model;

use App\Domain\Model\ReceivingConveyance;
use App\Domain\Model\Box;
use App\Domain\ValueObject\Weight;

/**
 * @model
 */
class Plane extends ReceivingConveyance
{
    public function __construct(Weight $weight)
    {
        parent::__construct(AgriculturalMachine::class, $weight);
    }
}
