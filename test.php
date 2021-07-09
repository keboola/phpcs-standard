<?php

declare(strict_types=1);

/*
test using:
docker run -it -v %CD%:/data php:7.4 bash
vendor/bin/phpcs --standard=src/ruleset.xml test.php

*/
namespace X {

    use InvalidArgumentException;
    use Y\U\W;

    class X
    {
        public function __construct()
        {
            $x = new InvalidArgumentException();
            $y = new \LogicException(\PHP_VERSION);
            echo \sprintf('%s', '1');
            echo sprintf('%s', '1');
            $date = new \DateTimeImmutable();
            $obj = new \Ns\MySecondClass();
            $obj2 = new W\TestClass();
            throw new \Exception();
        }
    }

    class Y
    {
        public function __construct()
        {
            $x = new X();
        }
    }
}

namespace Y\U\W {
    class TestClass
    {
    }
}
