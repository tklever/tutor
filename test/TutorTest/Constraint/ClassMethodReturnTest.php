<?php

namespace Klever\TutorTest\Constraint;

use Klever\Tutor\Constraint\ClassMethodReturn;
use Klever\TutorTest\TestAsset\FooProvider;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\TestCase;

class ClassMethodReturnTest extends TestCase
{
    /**
     * @var ClassMethodReturn $constraint
     */
    protected $constraint;

    /**
     * @var IsEqual
     */
    protected $subConstraint;

    protected function setUp()
    {
        $this->subConstraint = $subConstraint = new IsEqual(5);
        $this->constraint = new ClassMethodReturn('getFoo', $subConstraint);
    }

    public function testReturnsFalseOnMissingMethod()
    {
        $this->assertFalse(
            $this->constraint->evaluate(new \stdClass(), '', true)
        );
    }

    public function testReturnsFalseIfMethodExistsAndSubConstraintIsFalse()
    {
        $this->assertFalse(
            $this->constraint->evaluate(new FooProvider(3), '', true)
        );
    }

    public function testReturnsTrueIfMethodExistsAndSubConstraintIsTrue()
    {
        $this->assertTrue(
            $this->constraint->evaluate(new FooProvider(5), '', true)
        );
    }

    public function testCountIncrementsSubConstraintCountByOne()
    {
        $this->assertCount($this->subConstraint->count() + 1, $this->constraint);
    }

    public function testStringDescriptionAppendsSubConstraintDescription()
    {
        $description = $this->constraint->toString();
        $this->assertContains("implements the method 'getFoo' and the method return ", $description);
    }
}
