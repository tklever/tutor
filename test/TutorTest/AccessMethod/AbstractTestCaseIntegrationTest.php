<?php

namespace Klever\TutorTest\AccessMethod;

use Klever\Tutor\AccessMethod\AbstractTestCase;
use Klever\TutorTest\AccessMethod\TestAsset\Model;

class AbstractTestCaseIntegrationTest extends AbstractTestCase
{
    protected $model;

    protected function setUp()
    {
        $this->model = new Model(3);
    }

    public function getSubjectUnderTest()
    {
        return $this->model;
    }

    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'injectable_value' => 5
                ],
                'bar' => [
                    'default_value' => 3
                ],
                'fiz' => [
                    'default_value' => false
                ],
                'buz' => [
                    'default_value'   => true,
                    'injectable_value' => false,
                    'injection_method_fluent' => true,
                ],
                'fooANumber' => [
                    'default_value' => false,
                    'injector_name' => 'foo',
                    'injectable_value' => 4,
                    'expected_value'  => true
                ],
            ]
        ];
    }
}
