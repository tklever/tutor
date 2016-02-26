<?php

namespace Klever\TutorTest\Constraint;

use Klever\Tutor\Constraint\ArrayHasKeyAnd;
use PHPUnit_Framework_Constraint;
use PHPUnit_Framework_Constraint_IsEqual;

class ArrayHasKeyAndTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayHasKeyAnd $constraint
     */
    protected $constraint;

    /**
     * @var PHPUnit_Framework_Constraint | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $subConstraint;

    protected function setUp()
    {
        $this->subConstraint = $subConstraint = $this->getMock(PHPUnit_Framework_Constraint::class);
        $this->subConstraint = $subConstraint = new PHPUnit_Framework_Constraint_IsEqual('bar');
        $this->constraint = new ArrayHasKeyAnd('foo', $subConstraint);
    }

    public function testReturnsFalseOnMissingKey()
    {
        $this->assertFalse(
            $this->constraint->evaluate(array('baz' => 'bar'), '', true)
        );
    }

    public function testReturnsFalseIfMethodExistsAndSubConstraintIsFalse()
    {
        $this->assertFalse(
            $this->constraint->evaluate(array('foo' => 'baz'), '', true)
        );
    }

    public function testReturnsTrueIfMethodExistsAndSubConstraintIsTrue()
    {
        $this->assertTrue(
            $this->constraint->evaluate(array('foo' => 'bar'), '', true)
        );
    }

    public function testCountIncrementsSubConstraintCountByOne()
    {
        $this->assertCount($this->subConstraint->count() + 1, $this->constraint);
    }

    public function testStringDescriptionAppendsSubConstraintDescription()
    {
        $description = $this->constraint->toString();
        $this->assertContains('has the key \'foo\' and ', $description);
    }
}
