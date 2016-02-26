<?php

namespace Klever\TutorTest\AccessMethod;

use Klever\Tutor\AccessMethod\ClassMethodGeneratorTrait;

class ClassPropertyAccessMethodGeneratorTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassMethodGeneratorTrait | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $trait;

    protected function setUp()
    {
        $this->trait = $this->getMockForTrait(ClassMethodGeneratorTrait::class);
    }

    public function testPropertyAccessMethodReturnsProperMethodString()
    {
        $this->assertEquals('getPropertyOne', $this->trait->getAccessMethodForClassPropertyByName('propertyOne'));
    }

    public function testStateAccessMethodReturnsProperMethodString()
    {
        $this->assertEquals('isPropertyOne', $this->trait->getAccessMethodForClassStateByName('propertyOne'));
    }

    public function testInjectionMethodReturnsProperMethodString()
    {
        $this->assertEquals('setPropertyOne', $this->trait->getInjectionMethodForClassPropertyByName('propertyOne'));
    }
}
