<?php

namespace App\Domain\ValueObject;

/**
 * @value
 */
class Weight
{
    protected $value;
    protected $unit;

    public function __construct(float $value, string $unit)
    {
        $unit = strtolower($unit);
        if ($value <= 0) {
            throw new InvalidArgumentException('The weight must be greater than 0!');
        }
        if (!in_array($unit, ['kg', 't'])) {
            throw new InvalidArgumentException('Allowed units are "kg" and "t"!');
        }
        $this->value = $value;
        $this->unit = $unit;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

}
