<?php

namespace Computaria\Sphecific;

class OrSpecficationTest extends \PHPUnit_Framework_TestCase
{
    private $onlyObjectsSpecification = null;
    private $sizeSpecification = null;

    protected function setUp()
    {
        $this->onlyObjectsSpecification = new \Test\Stub\OnlyObjectsSpecification;
        $this->sizeSpecification = new \Test\Stub\MinimumArraySizeSpecification;
    }

    protected function tearDown()
    {
        $this->composite = null;
        $this->onlyObjectsSpecification = null;
    }

    public function testIsSatisfiedWhenBothOperandsAreSatisfied()
    {
        $orSpecification = new OrSpecification($this->onlyObjectsSpecification, $this->sizeSpecification);

        $arrayObject = new \ArrayObject(array(1, 2));

        $this->assertTrue($orSpecification->isSatisfiedBy($arrayObject));
    }

    public function testIsSatisfiedWhenOneOperandsIsNotSatisfied()
    {
        $orSpecification = new OrSpecification($this->onlyObjectsSpecification, $this->sizeSpecification);

        $arrayObject = new \ArrayObject(array(1));

        $this->assertTrue($orSpecification->isSatisfiedBy($arrayObject));
    }

    public function testIsNotSatisfiedWhenBothOperandsAreNotSatisfied()
    {
        $orSpecification = new OrSpecification($this->onlyObjectsSpecification, $this->sizeSpecification);

        $arrayObject = array();

        $this->assertFalse($orSpecification->isSatisfiedBy($arrayObject));
    }
}
