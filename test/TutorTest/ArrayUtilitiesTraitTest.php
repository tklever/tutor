<?php

namespace Klever\TutorTest;

use Klever\Tutor\ArrayUtilitiesTrait;
use PHPUnit\Framework\TestCase;

class ArrayUtilitiesTraitTest extends TestCase
{
    /**
     * @var ArrayUtilitiesTrait | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $trait;

    protected function setUp()
    {
        $this->trait = $this->getMockForTrait(ArrayUtilitiesTrait::class);
    }

    /**
     * @expectedException \PHPUnit\Framework\ExpectationFailedException
     */
    public function testKeyValueEqualAssertionThrowsExceptionOnFailure()
    {
        $this->trait->assertArrayHasKeyAndValueIsEqual(['foo' => 'bar'], 'foo', 'baz');
    }

    public function testKeyValueEqualAssertionDoesNotThrowExceptionOnSuccess()
    {
        $this->trait->assertArrayHasKeyAndValueIsEqual(['foo' => 'bar'], 'foo', 'bar');
    }
}
