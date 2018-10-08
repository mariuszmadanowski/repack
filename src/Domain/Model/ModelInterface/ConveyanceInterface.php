<?php

namespace App\Domain\Model\ModelInterface;

use App\Domain\Model\ModelInterface\CargoInterface;

interface ConveyanceInterface
{
    public function getTypeOfTransportedCargo();

    public function packCargo(CargoInterface $cargo);
}
