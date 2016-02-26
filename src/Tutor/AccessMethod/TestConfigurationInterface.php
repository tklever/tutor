<?php

namespace Klever\Tutor\AccessMethod;

interface TestConfigurationInterface
{
    /**
     * @return string
     */
    public function getAccessorName();

    /**
     * @return boolean
     */
    public function isStateAccessor();

    /**
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * @return boolean
     */
    public function isInjectionMethodTest();

    /**
     * @return string
     */
    public function getInjectorName();

    /**
     * @return mixed
     */
    public function getInjectableValue();

    /**
     * @return boolean
     */
    public function isInjectionMethodFluent();

    /**
     * @return mixed
     */
    public function getExpectedMutatedValue();
}
