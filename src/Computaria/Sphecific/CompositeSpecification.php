<?php

namespace Computaria\Sphecific;

class CompositeSpecification implements SpecificationInterface
{
    private $leafs = null;
    private $failedSpecification = null;

    public function __construct()
    {
        $this->leafs = new \SplObjectStorage;
        $this->failedSpecification = new \SplObjectStorage;
    }

    public function isSatisfiedBy($object)
    {
        foreach ($this->leafs as $leaf) {
            if (false === $leaf->isSatisfiedBy($object)) {
                $this->failedSpecification->attach($leaf);

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
        $this->failedSpecification->rewind();

        return $this->failedSpecification->current()->whyWasNotSatisfied();
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
