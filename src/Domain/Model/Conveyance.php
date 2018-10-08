<?php

namespace App\Domain\Model;

use App\Domain\Model\ModelInterface\ConveyanceInterface;
use App\Domain\Model\ModelInterface\CargoInterface;

/**
 * @model
 */
abstract class Conveyance implements ConveyanceInterface
{
    protected $typeOfTransportedCargo;
    protected $cargoElements = [];

    public function __construct(string $typeOfTransportedCargo)
    {
        $this->typeOfTransportedCargo = $typeOfTransportedCargo;
    }

    public function getTypeOfTransportedCargo(): string
    {
        return $this->typeOfTransportedCargo;
    }

    public function packCargo(CargoInterface $cargo): void
    {
        $this->cargoElements[] = $cargo;
        $cargo->setState(new CargoState($this));
    }
}
