<?php

namespace App\Application\Specification;

use App\Application\Specification\Specification;
use App\Domain\ValueObject\ReceivingCapacity;

class ReceivingCapacitySpecification extends Specification
{
    protected $receivingCapacity;

    public function __construct(ReceivingCapacity $receivingCapacity)
    {
        $this->receivingCapacity = $receivingCapacity;
    }

    public function isSatisfiedBy($object): bool
    {
        if ($object->getReceivingCapacity()->getWeight()->getValue() <= $this->receivingCapacity->getWeight()->getValue()
        && $object->getReceivingCapacity()->getWeight()->getUnit() == $this->receivingCapacity->getWeight()->getUnit()) {
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
