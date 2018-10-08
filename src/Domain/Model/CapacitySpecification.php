<?php

namespace App\Domain\Model;

use App\Domain\Model\Specification;
use App\Domain\ValueObject\Capacity;

class CapacitySpecification extends Specification
{
    protected $capacity;
    protected $minMax;

    public function __construct(Capacity $capacity, string $minMax)
    {
        $this->capacity = $capacity;
        $this->minMax = $minMax;
    }

    public function isSatisfiedBy($object): bool
    {
        if ($this->minMax == 'min') {
            $condition = ($object->getCapacity()->getQuantity() >= $this->capacity->getQuantity());
            return $this->isSatisfiedByHelper($object, $condition);
        } elseif ($this->minMax == 'max') {
            $condition = ($object->getCapacity()->getQuantity() <= $this->capacity->getQuantity());
            return $this->isSatisfiedByHelper($object, $condition);
        }

        return false;
    }

    private function isSatisfiedByHelper($object, bool $condition): bool
    {
        if ($condition) {
            if (isset($this->and)) {
                return $this->and->isSatisfiedBy($object);
            }
            return true;
        } elseif (isset($this->or)) {
            return $this->or->isSatisfiedBy($object);
        }

        return false;
    }
}
