<?php

namespace App\Domain\Model;

use App\Domain\Model\CargoInterface;

interface ReceivingConveyanceInterface
{
    public function getReceivingCapacity();

    public function isFull(CargoInterface $cargo);
}
