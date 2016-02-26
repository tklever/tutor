<?php

namespace Klever\Tutor\AccessMethod;

trait ClassMethodGeneratorTrait
{
    public function getAccessMethodForClassPropertyByName($propertyName)
    {
        return 'get' . ucfirst($propertyName);
    }

    public function getAccessMethodForClassStateByName($propertyName)
    {
        return 'is' . ucfirst($propertyName);
    }

    public function getInjectionMethodForClassPropertyByName($propertyName)
    {
        return 'set' . ucfirst($propertyName);
    }
}
