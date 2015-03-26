<?php

namespace Test\Stub;

use Computaria\Sphecific\SpecificationInterface;

class OnlyObjectsSpecification implements SpecificationInterface
{
    public function isSatisfiedBy($object)
    {
        return is_object($object);
    }

    public function whyWasNotSatisfied()
    {
        return 'Only objects will satisfy me!';
    }
}
