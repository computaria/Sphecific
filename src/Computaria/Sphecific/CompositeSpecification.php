<?php

namespace Computaria\Sphecific;

class CompositeSpecification implements SpecificationInterface
{
    private $leafs = null;
    private $failedSpecification = null;

    public function __construct()
    {
        $this->leafs = new \SplObjectStorage;
    }

    public function isSatisfiedBy($object)
    {
        foreach ($this->leafs as $leaf) {
            if (false === $leaf->isSatisfiedBy($object)) {
                $this->failedSpecification = $leaf;

                return false;
            }
        }

        return true;
    }

    public function remainsUnsatisfiedBy()
    {
        return $this->failedSpecification;
    }

    public function whyWasNotSatisfied()
    {
        return $this->failedSpecification->whyWasNotSatisfied();
    }

    public function add(SpecificationInterface $leafSpecification)
    {
        $this->leafs->attach($leafSpecification);

        return $this;
    }

    public function remove(SpecificationInterface $leafSpecification)
    {
        $this->leafs->detach($leafSpecification);
    }

    public function getChildren()
    {
        return $this->leafs;
    }
}
