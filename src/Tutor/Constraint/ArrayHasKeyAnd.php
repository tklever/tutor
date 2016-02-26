<?php

namespace Klever\Tutor\Constraint;

use PHPUnit_Framework_Constraint;
use PHPUnit_Framework_Constraint_ArrayHasKey;

class ArrayHasKeyAnd extends PHPUnit_Framework_Constraint_ArrayHasKey
{
    protected $constraint;

    public function __construct($key, PHPUnit_Framework_Constraint $constraint)
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
