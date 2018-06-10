<?php

namespace Klever\TutorTest\AccessMethod;

use Klever\Tutor\AccessMethod\TestConfiguration;
use Klever\Tutor\AccessMethod\TestConfigurationTrait;
use PHPUnit\Framework\TestCase;

class TestConfigurationTraitTest extends TestCase
{
    /**
     * @var TestConfigurationTrait | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $trait;

    protected function setUp()
    {
        $this->trait = $this->getMockForTrait(TestConfigurationTrait::class);
    }

    /**
     * @expectedException \PHPUnit\Framework\SkippedTestError
     */
    public function testTestWillBeMarkedIncompleteIfInvalidConfigurationIsProvided()
    {
        $this->trait->expects($this->any())
            ->method('getClassAccessMethodTestConfiguration')
            ->will($this->returnValue([
                'property_access' => 'INVALID',
            ]));

        $this->trait->getClassAccessMethodTestData();
    }

    /**
     * @expectedException \PHPUnit\Framework\SkippedTestError
     */
    public function testTestWillBeMarkedIncompleteIfNoConfigurationIsProvided()
    {
        $this->trait->expects($this->any())
            ->method('getClassAccessMethodTestConfiguration')
            ->will($this->returnValue([]));

        $this->trait->getClassAccessMethodTestData();
    }

    public function testRetrieveDefaultTestDataInCorrectListSequence()
    {
        $this->trait->expects($this->any())
            ->method('getClassAccessMethodTestConfiguration')
            ->will($this->returnValue([
                'accessors' => [
                    'foo' => [],
                ]
            ]));

        $dataProvider = $this->trait->getClassAccessMethodTestData();
        $this->assertCount(1, $dataProvider);

        $args = $dataProvider[0];
        $this->assertInternalType('array', $args);

        $configObject = $args[0];
        $this->assertInstanceOf(TestConfiguration::class, $configObject);
    }
}
