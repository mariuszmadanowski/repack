<?php

namespace App\Domain\Model;

use App\Domain\Model\ReceivingConveyanceInterface;
use App\Domain\Model\Conveyance;
use App\Domain\Model\CargoInterface;
use App\Domain\ValueObject\ReceivingCapacity;
use App\Domain\Model\CargoState;
use App\Domain\ValueObject\Weight;

/**
 * @model
 */
abstract class ReceivingConveyance extends Conveyance implements ReceivingConveyanceInterface
{
    protected $receivingCapacity;
    private $total = 0;

    public function __construct(string $typeOfTransportedCargo, Weight $weight)
    {
        parent::__construct($typeOfTransportedCargo);
        $this->receivingCapacity = new ReceivingCapacity($weight);
    }

    public function getReceivingCapacity(): ReceivingCapacity
    {
        return $this->receivingCapacity;
    }

    public function packCargo(CargoInterface $cargo): void
    {
        $this->cargoElements[] = $cargo;
        $this->total += $cargo->getWeight()->getValue();
        $cargo->setState(new CargoState($this));
    }

    public function isFull(CargoInterface $cargo): bool
    {
        $totalWeight = $this->total + $cargo->getWeight()->getValue();
        return ($totalWeight > $this->getReceivingCapacity()->getWeight()->getValue());
    }
}
