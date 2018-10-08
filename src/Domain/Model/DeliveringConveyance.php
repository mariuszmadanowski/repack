<?php

namespace App\Domain\Model;

use App\Domain\Model\DeliveringConveyanceInterface;
use App\Domain\Model\Conveyance;
use App\Domain\Model\CargoInterface;
use App\Domain\ValueObject\Capacity;
use App\Domain\Model\CargoState;

/**
 * @model
 */
abstract class DeliveringConveyance extends Conveyance implements DeliveringConveyanceInterface
{
    protected $capacity;

    public function __construct(string $typeOfTransportedCargo, int $quantity)
    {
        parent::__construct($typeOfTransportedCargo);
        $this->capacity = new Capacity($quantity);
    }

    public function getCapacity(): Capacity
    {
        return $this->capacity;
    }

    public function unpackCargo(): ?CargoInterface
    {
        $cargo = array_pop($this->cargoElements);
        if ($cargo) {
            $cargo->setState(new CargoState(null));
        }

        return $cargo;
    }
}
