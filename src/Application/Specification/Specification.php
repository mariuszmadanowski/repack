<?php

namespace App\Application\Specification;

use App\Application\Specification\SpecificationInterface;

abstract class Specification implements SpecificationInterface
{
    protected $and;
    protected $or;
    protected $not = false;

    public function andSatisfiedBy(SpecificationInterface $specification) {
        $this->and = $specification;
    }

    public function orSatisfiedBy(SpecificationInterface $specification) {
        $this->or = $specification;
    }

    public function not() {
        $this->not = true;
    }
}
