<?php

namespace Klever\Tutor\AccessMethod;

use PHPUnit_Framework_Assert as Assert;
use Klever\Tutor\ClassUtilitiesTrait;

trait TestTrait
{
    use ClassUtilitiesTrait;

    abstract public function getSubjectUnderTest();
    abstract public function getClassAccessMethodTestData();
    abstract public function getAccessMethodForClassStateByName($property);
    abstract public function getAccessMethodForClassPropertyByName($property);
    abstract public function getInjectionMethodForClassPropertyByName($property);

    public function injectClassPropertyViaAccessMethodForName($class, $property, $value)
    {
        $setterMethod = $this->getInjectionMethodForClassPropertyByName($property);
        return call_user_func(array($class, $setterMethod), $value);
    }

    protected function getAccessMethodByStateOrPropertyName(TestConfigurationInterface $config)
    {
        $property = $config->getAccessorName();
        if ($config->isStateAccessor()) {
            return $this->getAccessMethodForClassStateByName($property);
        }

        return $this->getAccessMethodForClassPropertyByName($property);
    }

    /**
     * @dataProvider getClassAccessMethodTestData
     * @param TestConfigurationInterface $config
     */
    public function testClassAccessorMethodsForName(TestConfigurationInterface $config)
    {
        $class = $this->getSubjectUnderTest();
        $accessorMethod = $this->getAccessMethodByStateOrPropertyName($config);
        $this->assertClassMethodReturnIsEqual(
            $class,
            $accessorMethod,
            $config->getDefaultValue(),
            0.0,
            10,
            false,
            false,
            'Access Method Default Value Assertion Failed'
        );

        if (!$config->isInjectionMethodTest()) {
            return;
        }

        $setterReturn = $this->injectClassPropertyViaAccessMethodForName(
            $class,
            $config->getInjectorName(),
            $config->getInjectableValue()
        );

        if ($config->isInjectionMethodFluent()) {
            Assert::assertSame($class, $setterReturn, 'Value Injection Method is not Fluent');
        }

        if ($config instanceof TestConfiguration && $config->isStrict()) {
            $this->assertClassMethodReturnIsIdentical(
                $class,
                $accessorMethod,
                $config->getExpectedMutatedValue(),
                'Access Method Mutated Value Assertion Failed'
            );
        }

        $this->assertClassMethodReturnIsEqual(
            $class,
            $accessorMethod,
            $config->getExpectedMutatedValue(),
            0.0,
            10,
            false,
            false,
            'Access Method Mutated Value Assertion Failed'
        );
    }
}
