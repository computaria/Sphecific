<?php

namespace Test\Stub;

use Computaria\Sphecific\SpecificationInterface;

class MinimumArraySizeSpecification implements SpecificationInterface
{
    public function isSatisfiedBy($object)
    {
        return (count($object) > 2);
    }

    public function whyWasNotSatisfied()
    {
        return 'Object size must be greater than 2';
    }
}
