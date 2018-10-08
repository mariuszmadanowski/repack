<?php

namespace App\Domain\Model;

use App\Domain\Model\CargoInterface;

interface DeliveringConveyanceInterface
{
    public function getCapacity();

    public function unpackCargo();
}
