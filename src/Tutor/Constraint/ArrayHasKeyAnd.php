<?php

namespace Klever\Tutor\Constraint;

use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\Constraint;

class ArrayHasKeyAnd extends ArrayHasKey
{
    protected $constraint;

    public function __construct($key, Constraint $constraint)
    {
        parent::__construct($key);
        $this->constraint = $constraint;
    }

    protected function matches($other)
    {
        if (!parent::matches($other)) {
            return false;
        }

        $value = $other[$this->key];
        return $this->constraint->evaluate($value, '', true);
    }

    public function count()
    {
        return $this->constraint->count() + 1;
    }

    public function toString()
    {
        return parent::toString()
            . ' and '
            . $this->constraint->toString();
    }
}
