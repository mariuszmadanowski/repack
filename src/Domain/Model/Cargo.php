<?php

namespace App\Domain\Model;

use App\Domain\Model\CargoInterface;
use App\Domain\Model\CargoStateInterface;
use App\Domain\ValueObject\Weight;

/**
 * @model
 */
abstract class Cargo implements CargoInterface
{
    protected $weight;
    protected $state;

    public function __construct(Weight $weight)
    {
        $this->weight = $weight;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function getState(): CargoStateInterface
    {
        return $this->state;
    }

    public function setState(CargoStateInterface $state): self
    {
        $this->state = $state;

        return $this;
    }

}
