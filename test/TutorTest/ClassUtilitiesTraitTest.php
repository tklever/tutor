<?php

namespace Klever\TutorTest;

use Klever\Tutor\ClassUtilitiesTrait;
use Klever\TutorTest\TestAsset\FooProvider;
use PHPUnit\Framework\TestCase;

class ClassUtilitiesTraitTest extends TestCase
{
    /**
     * @var ClassUtilitiesTrait | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $trait;

    protected function setUp()
    {
        $this->trait = $this->getMockForTrait(ClassUtilitiesTrait::class);
    }

    /**
     * @expectedException \PHPUnit\Framework\ExpectationFailedException
     */
    public function testClassReturnAssertionThrowsExceptionOnFailure()
    {
        $this->trait->assertClassMethodReturnIsEqual(new FooProvider(), 'getFoo', "NOT-VALID");
    }

    public function testClassReturnAssertionDoesNotThrowExceptionOnSuccess()
    {
        $this->trait->assertClassMethodReturnIsEqual(new FooProvider(), 'getFoo', null);
    }
}
