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
