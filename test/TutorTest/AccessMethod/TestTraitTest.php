<?php

namespace Klever\TutorTest\AccessMethod;

use Klever\Tutor\AccessMethod\TestTrait;
use Klever\TutorTest\AccessMethod\TestAsset\TestConfiguration;
use Klever\TutorTest\AccessMethod\TestAsset\FluentFooProvider;
use Klever\TutorTest\TestAsset\FooProvider;
use Klever\TutorTest\AccessMethod\TestAsset\StateProvider;
use PHPUnit_Framework_ExpectationFailedException;

class AccessMethodTestTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestTrait | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $trait;

    protected function setUp()
    {
        $this->trait = $this->getMockForTrait(TestTrait::class);
        $this->trait->expects($this->any())
            ->method('getAccessMethodForClassPropertyByName')
            ->will($this->returnValueMap([
                ['foo', 'getFoo'],
            ]));
        $this->trait->expects($this->any())
            ->method('getAccessMethodForClassStateByName')
            ->will($this->returnValueMap([
                ['active', 'isActive'],
                ['inactive', 'isInactive'],
            ]));
        $this->trait->expects($this->any())
            ->method('getInjectionMethodForClassPropertyByName')
            ->will($this->returnValueMap([
                ['foo', 'setFoo'],
                ['active', 'setActive'],
            ]));
    }

    public function testMethodTestClassAccessorMethodsForNameSucceedsOnDefaultNullValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $this->trait->testClassAccessorMethodsForName(
            new TestConfiguration('foo')
        );
    }

    public function testMethodTestClassAccessorMethodsForNameSucceedsOnEqualDefaultValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider(3)));

        $config = new TestConfiguration('foo');
        $config->setDefaultValue(3);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnOffByOneDefaultValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider(3)));

        $config = new TestConfiguration('foo');
        $config->setDefaultValue(4);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnArrayOrderDefaultValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider(['foo', 'bar'])));

        $config = new TestConfiguration('foo');
        $config->setDefaultValue(['bar', 'foo']);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnInvalidCaseDefaultValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider('foo')));

        $config = new TestConfiguration('foo');
        $config->setDefaultValue('FOO');

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnNonEqualDefaultValue()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setDefaultValue(3);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    public function testMethodTestClassAccessorMethodsForNameMutatesObject()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameMutatesObjectFailsOnOffByOne()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setExpectedMutatedValue(4);
        $config->setInjectableValue(3);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameMutatesObjectFailsOnArrayOrder()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setExpectedMutatedValue(['bar', 'foo']);
        $config->setInjectableValue(['foo', 'bar']);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameMutatesObjectFailsOnInvalidCase()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setExpectedMutatedValue('FOO');
        $config->setInjectableValue('foo');

        $this->trait->testClassAccessorMethodsForName($config);
    }

    public function testMethodTestClassAccessorMethodsForNameMutatesObjectWithProvidedParameters()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setExpectedMutatedValue(new \stdClass);
        $config->setInjectableValue(new \stdClass);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    public function testMethodTestClassAccessorMethodsForNameSucceedsOnFluentInterface()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FluentFooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setInjectionMethodFluent(true);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnNonFluentInterface()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new FooProvider()));

        $config = new TestConfiguration('foo');
        $config->setInjectionMethodTest(true);
        $config->setInjectionMethodFluent(true);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    public function testMethodTestClassAccessorMethodsForNameSucceedsWithDefaultState()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new StateProvider()));

        $config = new TestConfiguration('active');
        $config->setStateAccessor(true);
        $config->setDefaultValue(false);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsWithInvalidDefaultState()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new StateProvider()));

        $config = new TestConfiguration('active');
        $config->setStateAccessor(true);
        $config->setDefaultValue(true);

        $this->trait->testClassAccessorMethodsForName($config);
    }

    public function testMethodTestClassAccessorMethodsForNameSucceedsOnControlPropertyInjection()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new StateProvider()));

        $config = new TestConfiguration('inactive');
        $config->setStateAccessor(true);
        $config->setDefaultValue(true);
        $config->setInjectionMethodTest(true);
        $config->setInjectableValue(false);
        $config->setInjectorName('active');

        $this->trait->testClassAccessorMethodsForName($config);
    }

    /**
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     */
    public function testMethodTestClassAccessorMethodsForNameFailsOnInvalidExpectation()
    {
        $this->trait->expects($this->any())
            ->method('getSubjectUnderTest')
            ->will($this->returnValue(new StateProvider()));

        $config = new TestConfiguration('inactive');
        $config->setStateAccessor(true);
        $config->setDefaultValue(true);
        $config->setInjectionMethodTest(true);
        $config->setInjectableValue(true);
        $config->setInjectorName('active');

        $this->trait->testClassAccessorMethodsForName($config);
    }
}
