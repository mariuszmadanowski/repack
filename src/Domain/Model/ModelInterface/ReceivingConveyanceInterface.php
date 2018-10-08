<?php

namespace App\Domain\Model\ModelInterface;

use App\Domain\Model\ModelInterface\CargoInterface;

interface ReceivingConveyanceInterface
{
    public function getReceivingCapacity();

    public function isFull(CargoInterface $cargo);
}
