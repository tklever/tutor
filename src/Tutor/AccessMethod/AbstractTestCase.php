<?php

namespace Klever\Tutor\AccessMethod;

use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    use TestTrait;
    use ClassMethodGeneratorTrait;
    use TestConfigurationTrait;
}
