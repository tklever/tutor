<?php

namespace Klever\Tutor\AccessMethod;

use PHPUnit_Framework_TestCase;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    use TestTrait;
    use ClassMethodGeneratorTrait;
    use TestConfigurationTrait;
}
