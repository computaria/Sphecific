<?php

namespace Computaria\Sphecific;

class CompositeSpecificationTest extends \PHPUnit_Framework_TestCase
{
    private $composite = null;
    private $onlyObjectsSpecification = null;
    private $sizeSpecification = null;

    protected function setUp()
    {
        $this->composite = new CompositeSpecification;
        $this->onlyObjectsSpecification = new \Test\Stub\OnlyObjectsSpecification;
        $this->sizeSpecification = new \Test\Stub\MinimumArraySizeSpecification;
    }

    protected function tearDown()
    {
        $this->composite = null;
        $this->onlyObjectsSpecification = null;
    }

    public function testAdd()
    {
        $this->composite->add($this->onlyObjectsSpecification);

        $this->assertContains($this->onlyObjectsSpecification, $this->composite->getChildren());
    }

    public function testRemove()
    {
        $this->composite->add($this->onlyObjectsSpecification);
        $this->composite->remove($this->onlyObjectsSpecification);

        $this->assertNotContains($this->onlyObjectsSpecification, $this->composite->getChildren());
    }

    public function testIsSatisfiedByShouldReturnConjunctionOfLeafSpecifications()
    {
        $this->composite->add($this->onlyObjectsSpecification);
        $this->composite->add($this->sizeSpecification);

        $this->assertFalse($this->composite->isSatisfiedBy(new \ArrayObject));
    }

    public function testWhyWasNotSatisfiedShouldReturnTheReasonWhySpecificationWasNotSatisfied()
    {
        $this->composite->add($this->onlyObjectsSpecification);
        $this->composite->add($this->sizeSpecification);

        $this->composite->isSatisfiedBy(new \ArrayObject);

        $this->assertEquals($this->sizeSpecification->whyWasNotSatisfied(), $this->composite->whyWasNotSatisfied());
    }

    public function testRemainsUnsatisfiedByShouldReturnFailedSpecification()
    {
        $this->composite->add($this->sizeSpecification);

        $this->composite->isSatisfiedBy(new \ArrayObject);

        $this->assertSame($this->sizeSpecification, $this->composite->remainsUnsatisfiedBy());
    }
}
