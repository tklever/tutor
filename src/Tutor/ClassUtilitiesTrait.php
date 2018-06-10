<?php

namespace Klever\Tutor;

use Klever\Tutor\Constraint\ClassMethodReturn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsIdentical;

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
            new IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase)
        );
        Assert::assertThat($class, $constraint, $message);
    }

    public function assertClassMethodReturnIsIdentical(
        $class,
        $method,
        $value,
        $message = ''
    ) {
        $constraint = new ClassMethodReturn(
            $method,
            new IsIdentical($value)
        );
        Assert::assertThat($class, $constraint, $message);
    }
}
