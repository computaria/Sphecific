<?php

namespace Computaria\Sphecific;

class OrSpecification implements SpecificationInterface
{
    private $leftOperand = null;
    private $rightOperand = null;

    public function __construct(SpecificationInterface $leftOperand, SpecificationInterface $rightOperand)
    {
        $this->leftOperand = $leftOperand;
        $this->rightOperand = $rightOperand;
    }

    public function isSatisfiedBy($object)
    {
        return ($this->leftOperand->isSatisfiedBy($object) || $this->rightOperand->isSatisfiedBy($object));
    }

    public function whyWasNotSatisfied()
    {
        return $this->leftOperand->whyWasNotSatisfied() . " and " . $this->rightOperand->whyWasNotSatisfied();
    }
}
