<?php

namespace Klever\Tutor\Constraint;

use PHPUnit_Framework_Constraint;

class ClassMethodReturn extends PHPUnit_Framework_Constraint
{
    protected $method;
    protected $constraint;

    public function __construct($method, PHPUnit_Framework_Constraint $constraint)
    {
        parent::__construct();
        $this->method     = $method;
        $this->constraint = $constraint;
    }

    protected function matches($other)
    {
        if (!is_callable(array($other, $this->method))) {
            return false;
        }

        $value = call_user_func(array($other, $this->method));
        return $this->constraint->evaluate($value, '', true);
    }

    public function count()
    {
        return $this->constraint->count() + 1;
    }

    protected function failureDescription($other)
    {
        $otherString = is_object($other) ? get_class($other) : gettype($other);
        return parent::failureDescription($otherString);
    }

    public function toString()
    {
        return 'implements the method \'' . $this->method . '\' and the method return '
            . $this->constraint->toString();
    }
}
