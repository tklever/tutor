<?php

namespace Klever\TutorTest\TestAsset;

class FooProvider
{
    private $foo;

    public function __construct($foo = null)
    {
        $this->foo = $foo;
    }

    /**
     * @return mixed
     */
    public function getFoo()
    {
        return $this->foo;
    }

    /**
     * @param mixed $foo
     */
    public function setFoo($foo)
    {
        $this->foo = $foo;
    }
}
