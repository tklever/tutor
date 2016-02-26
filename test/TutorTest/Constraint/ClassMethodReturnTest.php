<?php

namespace Klever\TutorTest\Constraint;

use Klever\Tutor\Constraint\ClassMethodReturn;
use Klever\TutorTest\TestAsset\FooProvider;
use PHPUnit_Framework_Constraint_IsEqual;

class ClassMethodReturnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassMethodReturn $constraint
     */
    protected $constraint;

    /**
     * @var PHPUnit_Framework_Constraint_IsEqual
     */
    protected $subConstraint;

    protected function setUp()
    {
        $this->subConstraint = $subConstraint = new PHPUnit_Framework_Constraint_IsEqual(5);
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
