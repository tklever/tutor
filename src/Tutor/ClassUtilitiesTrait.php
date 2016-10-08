<?php

namespace Klever\Tutor;

use Klever\Tutor\Constraint\ClassMethodReturn;
use PHPUnit_Framework_Constraint_IsEqual;
use PHPUnit_Framework_Assert;
use PHPUnit_Framework_Constraint_IsIdentical;

trait ClassUtilitiesTrait
{
    public function assertClassMethodReturnIsEqual(
        $class,
        $method,
        $value,
        $delta = 0.0,
        $maxDepth = 10,
        $canonicalize = false,
        $ignoreCase = false,
        $message = ''
    ) {
        $constraint = new ClassMethodReturn(
            $method,
            new PHPUnit_Framework_Constraint_IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase)
        );
        PHPUnit_Framework_Assert::assertThat($class, $constraint, $message);
    }

    public function assertClassMethodReturnIsIdentical(
        $class,
        $method,
        $value,
        $message = ''
    ) {
        $constraint = new ClassMethodReturn(
            $method,
            new PHPUnit_Framework_Constraint_IsIdentical($value)
        );
        PHPUnit_Framework_Assert::assertThat($class, $constraint, $message);
    }
}
