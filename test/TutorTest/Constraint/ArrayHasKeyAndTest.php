<?php

namespace Klever\TutorTest\Constraint;

use Klever\Tutor\Constraint\ArrayHasKeyAnd;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ArrayHasKeyAndTest extends TestCase
{
    /**
     * @var ArrayHasKeyAnd $constraint
     */
    protected $constraint;

    /**
     * @var Constraint | MockObject
     */
    protected $subConstraint;

    protected function setUp()
    {
        $this->subConstraint = $subConstraint = $this->getMockBuilder(Constraint::class)->getMock();
        $this->subConstraint = $subConstraint = new IsEqual('bar');
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
