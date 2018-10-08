<?php

namespace App\Domain\ValueObject;

/**
 * @value
 */
class Capacity
{
    protected $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
