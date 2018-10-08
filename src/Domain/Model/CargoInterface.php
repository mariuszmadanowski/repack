<?php

namespace App\Domain\Model;

use App\Domain\Model\CargoStateInterface;

interface CargoInterface
{
    public function getWeight();

    public function getState();

    public function setState(CargoStateInterface $state);
}
