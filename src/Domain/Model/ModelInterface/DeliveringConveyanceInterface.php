<?php

namespace App\Domain\Model\ModelInterface;

use App\Domain\Model\ModelInterface\CargoInterface;

interface DeliveringConveyanceInterface
{
    public function getCapacity();

    public function unpackCargo();
}
