<?php

namespace Klever\Tutor;

use Klever\Tutor\Constraint\ArrayHasKeyAnd;
use PHPUnit_Framework_Assert;
use PHPUnit_Framework_Constraint_IsEqual;

trait ArrayUtilitiesTrait
{
    public function assertArrayHasKeyAndValueIsEqual(
        array $array,
        $key,
        $value,
        $delta = 0.0,
        $maxDepth = 10,
        $canonicalize = false,
        $ignoreCase = false,
        $message = ''
    ) {
        $constraint = new ArrayHasKeyAnd(
            $key,
            new PHPUnit_Framework_Constraint_IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase)
        );
        PHPUnit_Framework_Assert::assertThat($array, $constraint, $message);
    }
}
