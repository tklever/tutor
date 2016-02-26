<?php

namespace Klever\TutorTest\AccessMethod\TestAsset;

use Klever\Tutor\AccessMethod\TestConfigurationInterface;

class TestConfiguration implements TestConfigurationInterface
{
    private $accessorName;
    private $stateAccessor = false;
    private $defaultValue = null;
    private $injectionMethodTest = false;
    private $injectableValue = true;
    private $expectedMutatedValue = true;
    private $injectionMethodFluent = false;
    private $injectorName;

    public function __construct($accessorName)
    {
        $this->accessorName = $accessorName;
        $this->injectorName = $accessorName;
    }

    /**
     * @return string
     */
    public function getAccessorName()
    {
        return $this->accessorName;
    }

    /**
     * @return boolean
     */
    public function isStateAccessor()
    {
        return $this->stateAccessor;
    }

    /**
     * @param boolean $stateAccessor
     */
    public function setStateAccessor($stateAccessor)
    {
        $this->stateAccessor = $stateAccessor;
    }

    /**
     * @return null
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param null $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return boolean
     */
    public function isInjectionMethodTest()
    {
        return $this->injectionMethodTest;
    }

    /**
     * @param boolean $injectionMethodTest
     */
    public function setInjectionMethodTest($injectionMethodTest)
    {
        $this->injectionMethodTest = $injectionMethodTest;
    }

    /**
     * @return mixed
     */
    public function getInjectableValue()
    {
        return $this->injectableValue;
    }

    /**
     * @param mixed $injectableValue
     */
    public function setInjectableValue($injectableValue)
    {
        $this->injectableValue = $injectableValue;
    }

    /**
     * @return mixed
     */
    public function getExpectedMutatedValue()
    {
        return $this->expectedMutatedValue;
    }

    /**
     * @param mixed $expectedMutatedValue
     */
    public function setExpectedMutatedValue($expectedMutatedValue)
    {
        $this->expectedMutatedValue = $expectedMutatedValue;
    }

    /**
     * @return boolean
     */
    public function isInjectionMethodFluent()
    {
        return $this->injectionMethodFluent;
    }

    /**
     * @param boolean $injectionMethodFluent
     */
    public function setInjectionMethodFluent($injectionMethodFluent)
    {
        $this->injectionMethodFluent = $injectionMethodFluent;
    }

    /**
     * @return mixed
     */
    public function getInjectorName()
    {
        return $this->injectorName;
    }

    /**
     * @param mixed $injectorName
     */
    public function setInjectorName($injectorName)
    {
        $this->injectorName = $injectorName;
    }
}
