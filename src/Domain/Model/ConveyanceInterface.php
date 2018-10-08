<?php

namespace App\Domain\Model;

use App\Domain\Model\CargoInterface;

interface ConveyanceInterface
{
    public function getTypeOfTransportedCargo();

    public function packCargo(CargoInterface $cargo);
}
