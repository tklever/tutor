<?php

namespace Klever\Tutor\AccessMethod;

use Klever\Tutor\AccessMethod\Exception;

class TestConfiguration implements TestConfigurationInterface
{
    private $accessorName;
    private $stateAccessor = false;
    private $stateAccessorExplicit = false;
    private $defaultValue;
    private $defaultValueExplicit = false;
    private $injectionMethodTest = false;
    private $injectionMethodTestExplicit = false;
    private $expectedMutatedValue;
    private $expectedMutatedValueExplicit = false;
    private $injectableValue = true;
    private $injectableValueExplicit = false;
    private $injectionMethodFluent = false;
    private $injectorName;

    /**
     * @return mixed
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
        if ($this->stateAccessorExplicit) {
            return $this->stateAccessor;
        }

        if ($this->defaultValueExplicit && is_bool($this->defaultValue)) {
            return true;
        }

        return false;
    }

    /**
     * @param boolean $stateAccessor
     */
    private function setStateAccessor($stateAccessor)
    {
        $this->stateAccessor = (bool) $stateAccessor;
        $this->stateAccessorExplicit = true;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        if ($this->defaultValueExplicit) {
            return $this->defaultValue;
        }

        if ($this->stateAccessorExplicit && $this->stateAccessor === true) {
            return false;
        }


        return null;
    }

    /**
     * @param mixed $defaultValue
     */
    private function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        $this->defaultValueExplicit = true;
    }

    /**
     * @return boolean
     */
    public function isInjectionMethodTest()
    {
        if ($this->injectionMethodTestExplicit) {
            return $this->injectionMethodTest;
        }

        if ($this->isInjectionMethodFluent()
            || $this->expectedMutatedValueExplicit
            || $this->injectableValueExplicit
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param boolean $injectionMethodTest
     */
    private function setInjectionMethodTest($injectionMethodTest)
    {
        $this->injectionMethodTest = (bool) $injectionMethodTest;
        $this->injectionMethodTestExplicit = true;

    }

    /**
     * @return mixed
     */
    public function getInjectorName()
    {
        if ($this->injectorName === null) {
            return $this->getAccessorName();
        }
        return $this->injectorName;
    }

    /**
     * @return mixed
     */
    public function getInjectableValue()
    {
        if ($this->injectableValueExplicit) {
            return $this->injectableValue;
        }

        return true;
    }

    /**
     * @param mixed $injectableValue
     */
    private function setInjectableValue($injectableValue)
    {
        $this->injectableValue = $injectableValue;
        $this->injectableValueExplicit = true;
    }

    /**
     * @return boolean
     */
    public function isInjectionMethodFluent()
    {
        return $this->injectionMethodFluent;
    }

    /**
     * @return mixed
     */
    public function getExpectedMutatedValue()
    {
        if ($this->expectedMutatedValueExplicit) {
            return $this->expectedMutatedValue;
        }

        return $this->getInjectableValue();
    }

    /**
     * @param mixed $expectedMutatedValue
     */
    private function setExpectedMutatedValue($expectedMutatedValue)
    {
        $this->expectedMutatedValue = $expectedMutatedValue;
        $this->expectedMutatedValueExplicit = true;
    }

    public static function fromArray(array $data)
    {
        $config = new self;

        if (!isset($data['accessor_name'])) {
            throw new Exception\InvalidArgumentException();
        }

        $config->accessorName = $data['accessor_name'];

        if (isset($data['is_state_accessor'])) {
            $config->setStateAccessor($data['is_state_accessor']);
        }

        if (isset($data['default_value'])) {
            $config->setDefaultValue($data['default_value']);
        }

        if (isset($data['injection_method_test'])) {
            $config->setInjectionMethodTest($data['injection_method_test']);
        }

        if (isset($data['expected_value'])) {
            $config->setExpectedMutatedValue($data['expected_value']);
        }

        if (isset($data['injectable_value'])) {
            $config->setInjectableValue($data['injectable_value']);
        }

        $config->injectionMethodFluent = isset($data['injection_method_fluent'])
            ? $data['injection_method_fluent'] : false;

        $config->injectorName = isset($data['injector_name']) ? $data['injector_name'] : null;

        return $config;
    }
}
