# Keboola Coding Standard

### Versioning

* patch versions may only weaken the checks if a bug in a sniff is found
* minor versions may only update underlying coding standards with bugfixes
* major versions may introduce new sniffs, thus causing previously good builds to fail

So you should be usually fine with composer's default `^major.minor`

## Installation

* install via composer 
```
composer require --dev keboola/coding-standard
```

* copy `example/phpcs.xml` to your project root directory.
* now you can check your `src` and `tests` directory using
```
vendor/bin/phpcs src tests
```

* add phpcs script to composer.json

```
{
...
    "scripts": {
        "phpcs": "phpcs -n --extensions=php ."
    }
}
```

## Usage

`composer phpcs`

### Using standard on legacy projects

If fixing the violations is too complex, you can exclude the respective sniffs. 

First you need to know which sniff is causing the violation.

```
composer phpcs -- -s
```

This will dump the sniff name along with the violation.

```
phpcs -n --extensions=php . "-s"

FILE: W:\keboola\http-extractor\src\Config.php
----------------------------------------------------------------------
FOUND 1 ERROR AFFECTING 1 LINE
----------------------------------------------------------------------
 11 | ERROR | Method \Keboola\HttpExtractor\Config::getBaseUrl() does not
    |       | have return type hint nor @return annotation for its return
    |       | value.
    |       | (SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint)
----------------------------------------------------------------------
``` 

Then add the sniff to excludes in your `phpcs.xml`

```php
<?xml version="1.0"?>
<ruleset name="Custom">
    <rule ref="vendor/keboola/coding-standard/ruleset.xml">
		<exclude name="SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint" />
	</rule>
</ruleset>
```

Repeat until there are no violations. 

You may take note of fixable violations and separate them visually in the file, possibly with `<!-- Fixable violations below -->`. That way anyone can remove one exclusion at a time, let `phpcbf` fix the violation, review the result and submit a PR with a fix. This will improve the chances of fixing the violations in the future. 
