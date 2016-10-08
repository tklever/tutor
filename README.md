# klever/tutor
Easily test accessor methods on your models by providing a spec in your test case.

# Installation
```bash
composer require --dev klever/tutor
```

# Usage
Extend `\Klever\Tutor\AccessMethod\AbstractTestCase` and provide a spec for your model.

# Example
[`\Klever\TutorTest\AccessMethod\AbstractTestCaseIntegrationTest`](test/TutorTest/AccessMethod/AbstractTestCaseIntegrationTest.php)

# Configuration
[`\Klever\Tutor\AccessMethod\TestConfiguration::fromArray`](src/Tutor/AccessMethod/TestConfiguration.php)

## accessor_name
Override for non-conventional getters.

### Sample Class
```
class Model
{
    private $foo;
    
    public function getBar()
    {
        return $this->foo;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'accessor_name' => 'getBar',
                ],
            ],
        ];
    }
}
```

## is_state_accessor
Use an `is` accessor instead of a `get` accessor.

### Sample Class
```
class Model
{
    private $foo = true;
    
    public function isFoo()
    {
        return $this->foo;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'is_state_accessor' => true,
                ],
            ],
        ];
    }
}
```

## default_value
Default value of a property.

### Sample Class
```
class Model
{
    private $foo = 'bar';
    
    public function getFoo()
    {
        return $this->foo;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'default_value' => 'bar',
                ],
            ],
        ];
    }
}
```

## injectable_value
Value set into a property. This will be validated as the `expected_value` by default.

### Sample Class
```
class Model
{
    private $foo;
    
    public function getFoo()
    {
        return $this->foo;
    }
    
    public function setFoo($foo)
    {
        $this->foo = $foo;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'injectable_value' => 'bar',
                ],
            ],
        ];
    }
}
```

## expected_value
Expected value of a property.

### Sample Class
```
class Model
{
    private $foo;
    
    public function getFoo()
    {
        return $this->foo;
    }
    
    public function setFoo($foo)
    {
        $this->foo = $foo . 'bar';
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'injectable_value' => 'foo',
                    'expected_value' => 'foobar',
                ],
            ],
        ];
    }
}
```

## injection_method_fluent
Validates that the setter returns the model.

### Sample Class
```
class Model
{
    private $foo;
    
    public function setFoo($foo)
    {
        $this->foo = $foo;
        return $this;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'injectable_value' => 'foo',
                    'injection_method_fluent' => true,
                ],
            ],
        ];
    }
}
```

## injector_name
Override for non-conventional setters.

### Sample Class
```
class Model
{
    private $foo;
    
    public function setBar($bar)
    {
        $this->foo = $bar;
    }
}
```

### Sample Config
```
class ModelTest extends \Klever\Tutor\AccessMethod\AbstractTestCase
{
    public function getClassAccessMethodTestConfiguration()
    {
        return [
            'accessors' => [
                'foo' => [
                    'injectable_value' => 'foo',
                    'injector_name' => 'setBar',
                ],
            ],
        ];
    }
}
```

# Dependencies
See [composer.json](composer.json).

## Contributing
```bash
git clone git@github.com:tklever/tutor.git && cd tutor
composer update && vendor/bin/phing
```

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
