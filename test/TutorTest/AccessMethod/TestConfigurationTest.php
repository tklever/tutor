<?php

namespace Klever\TutorTest\AccessMethod;

use Klever\Tutor\AccessMethod\TestConfiguration;
use PHPUnit\Framework\TestCase;

class AccessMethodTestConfigurationTest extends TestCase
{
    /**
     * @expectedException \Klever\Tutor\AccessMethod\Exception\InvalidArgumentException
     */
    public function testThrowsExceptionOnMissingAccessorName()
    {
        TestConfiguration::fromArray([]);
    }

    public function testAccessMethodForAccessorName()
    {
        $config = TestConfiguration::fromArray(['accessor_name' => 'foo']);
        $this->assertEquals('foo', $config->getAccessorName());
    }

    public function testAccessMethodForDefaultDefaultValue()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
        ]);
        $this->assertNull($config->getDefaultValue());
    }

    public function testAccessMethodForDefaultValue()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'default_value' => 'bar'
        ]);
        $this->assertEquals('bar', $config->getDefaultValue());
    }

    public function testBooleanDefaultValueSetsTestAsState()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'default_value' => false
        ]);
        $this->assertTrue($config->isStateAccessor());
    }

    public function testBooleanDefaultValueWillNotOverrideStateConfiguration()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'default_value' => false,
            'is_state_accessor' => false
        ]);
        $this->assertFalse($config->isStateAccessor());
    }

    public function testStateAccessorTestWillSetDefaultValueToBoolean()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'is_state_accessor' => true
        ]);
        $this->assertFalse($config->getDefaultValue());
    }

    public function testStateAccessorTestWillLeaveDefaultValueAsNull()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'is_state_accessor' => false
        ]);
        $this->assertNull($config->getDefaultValue());
    }

    public function testInjectionTestCanBeExplicitlySet()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'injection_method_test' => true
        ]);
        $this->assertTrue($config->isInjectionMethodTest());
    }

    public function testInjectionTestReturnsTrueIfInjectionIsFluent()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'injection_method_fluent' => true
        ]);
        $this->assertTrue($config->isInjectionMethodTest());
    }

    public function testInjectionTestReturnsTrueIfExpectedValueIsProvided()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'expected_value' => 'SOME-VALUE'
        ]);
        $this->assertTrue($config->isInjectionMethodTest());
    }

    public function testInjectionTestReturnsTrueIfInjectionValueIsProvided()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
            'injectable_value' => 'SOME-VALUE'
        ]);
        $this->assertTrue($config->isInjectionMethodTest());
    }

    public function testInjectableValueIsTrueByDefault()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
        ]);
        $this->assertTrue($config->getInjectableValue());
    }

    public function testInjectionMethodFluentIsFalseByDefault()
    {
        $config = TestConfiguration::fromArray([
            'accessor_name' => 'foo',
        ]);
        $this->assertFalse($config->isInjectionMethodFluent());
    }
}
