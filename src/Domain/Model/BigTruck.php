<?php

namespace App\Domain\Model;

use App\Domain\Model\DeliveringConveyance;
use App\Domain\Model\AgriculturalMachine;

/**
 * @model
 */
class BigTruck extends DeliveringConveyance
{
    public function __construct(int $quantity)
    {
        parent::__construct(AgriculturalMachine::class, $quantity);
    }
}
