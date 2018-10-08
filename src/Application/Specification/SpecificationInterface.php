<?php

namespace App\Application\Specification;

interface SpecificationInterface
{
    /**
     * @return boolean
     */
    public function isSatisfiedBy($object);

    /**
     * @return SpecificationInterface
     */
    public function andSatisfiedBy(SpecificationInterface $specification);

    /**
     * @return SpecificationInterface
     */
    public function orSatisfiedBy(SpecificationInterface $specification);

    public function not();
}
