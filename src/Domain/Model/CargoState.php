<?php

namespace App\Domain\Model;

use App\Domain\Model\Conveyance;
use App\Domain\Model\ModelInterface\CargoStateInterface;

/**
 * @model
 */
class CargoState implements CargoStateInterface
{
    protected $conveyance;

    public function __construct(?Conveyance $conveyance)
    {
        $this->conveyance = $conveyance;
    }

    public function getConveyance(): Conveyance
    {
        return $this->conveyance;
    }

}
