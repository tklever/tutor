<?php

namespace Klever\Tutor;

use Klever\Tutor\Constraint\ArrayHasKeyAnd;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\IsEqual;

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
            new IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase)
        );
        Assert::assertThat($array, $constraint, $message);
    }
}
