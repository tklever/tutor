<?php

namespace Klever\TutorTest\AccessMethod\TestAsset;

class Model
{
    private $foo;
    private $bar;
    private $fiz = false;
    private $buz = true;
    private $strict = false;

    /**
     * AccessMethodProvidingModel constructor.
     * @param $bar
     */
    public function __construct($bar)
    {
        $this->bar = $bar;
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

    /**
     * @return mixed
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @return boolean
     */
    public function isFiz()
    {
        return $this->fiz;
    }

    /**
     * @return boolean
     */
    public function isBuz()
    {
        return $this->buz;
    }

    /**
     * @param boolean $buz
     * @return $this
     */
    public function setBuz($buz)
    {
        $this->buz = $buz;
        return $this;
    }

    public function isFooANumber()
    {
        return is_numeric($this->foo);
    }

    /**
     * @return boolean
     */
    public function isStrict()
    {
        return $this->strict;
    }

    /**
     * @param boolean $strict
     */
    public function setStrict($strict)
    {
        $this->strict = (boolean) $strict;
    }
}
