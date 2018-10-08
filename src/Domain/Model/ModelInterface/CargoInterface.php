<?php

namespace App\Domain\Model\ModelInterface;

use App\Domain\Model\ModelInterface\CargoStateInterface;

interface CargoInterface
{
    public function getWeight();

    public function getState();

    public function setState(CargoStateInterface $state);
}
