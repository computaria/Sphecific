<?php

namespace Computaria\Sphecific;

interface SpecificationInterface
{
    public function isSatisfiedBy($object);
    public function whyWasNotSatisfied();
}
