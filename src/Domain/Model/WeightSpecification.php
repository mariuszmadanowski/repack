<?php

namespace App\Domain\Model;

use App\Domain\Model\Specification;
use App\Domain\ValueObject\Weight;

class WeightSpecification extends Specification
{
    protected $weight;
    protected $minMax;

    public function __construct(Weight $weight, string $minMax)
    {
        $this->weight = $weight;
        $this->minMax = $minMax;
    }

    public function isSatisfiedBy($object): bool
    {
        if ($this->minMax == 'min') {
            $subCondition = ($object->getWeight()->getValue() >= $this->weight->getValue());
            return $this->isSatisfiedByHelper($object, $subCondition);
        } elseif ($this->minMax == 'max') {
            $subCondition = ($object->getWeight()->getValue() <= $this->weight->getValue());
            return $this->isSatisfiedByHelper($object, $subCondition);
        }

        return false;
    }

    private function isSatisfiedByHelper($object, bool $subCondition): bool
    {
        if (
            $subCondition
            && $object->getWeight()->getUnit() == $this->weight->getUnit()
        ) {
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
