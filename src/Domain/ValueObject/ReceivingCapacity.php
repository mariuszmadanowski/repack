<?php

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\Weight;

/**
 * @value
 */
class ReceivingCapacity
{
    protected $weight;

    public function __construct(Weight $weight)
    {
        $this->weight = $weight;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

}
