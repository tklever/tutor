<?php

namespace Klever\TutorTest\AccessMethod\TestAsset;

use Klever\TutorTest\TestAsset\FooProvider;

class FluentFooProvider extends FooProvider
{
    public function setFoo($foo)
    {
        parent::setFoo($foo);
        return $this;
    }
}
