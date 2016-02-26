<?php

namespace Klever\Tutor\AccessMethod;

use PHPUnit_Framework_SkippedTestError;

trait TestConfigurationTrait
{
    abstract public function getClassAccessMethodTestConfiguration();

    protected function validateConfiguration($config)
    {
        $accessors = (isset($config['accessors']) && is_array($config['accessors']))
            ? $config['accessors'] : array();

        if (count($accessors) === 0) {
            throw new PHPUnit_Framework_SkippedTestError(
                'No class access method test configuration provided'
            );
        }
    }

    public function getClassAccessMethodTestData()
    {
        $config = $this->getClassAccessMethodTestConfiguration();
        $this->validateConfiguration($config);

        $data = array();
        foreach ($config['accessors'] as $name => $propertyConfig) {
            if (!isset($propertyConfig['accessor_name'])) {
                $propertyConfig['accessor_name'] = $name;
            }

            $data[] = array(TestConfiguration::fromArray($propertyConfig));
        }

        return $data;
    }
}
